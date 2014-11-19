<?php

/**
 * company handler
 * @author    Uldis Nelsons
 */

/**
 * Handles user company detection and application setting by URL parm specified in
 * @author  Uldis Nelsons
 * @package d2company.components
 */
class companyHandler extends CApplicationComponent
{
    /**
     * $_GET param used for language detection
     */
    public $data_key = FALSE;
    /**
     * user companies
     * @var array
     */
    public $companies = array();

    /**
     * active company
     * @var int
     */
    public $_activeCompany = FALSE;
    public $_activeCompanyName = FALSE;

    private $_aUserCompanies = FALSE;
    
    public $ccuc_status = FALSE;
    public $profiles_ccmp_field = FALSE;
    private $_company_attributes = FALSE;
    
    private $_auth_items = array();
    
    /**
     * Handles company detection and application setting by URL parm specified in DATA_KEY
     */
    public function init()
    {
        //user model required
        if(!Yii::app()->hasModule('user')){
            return false;
        }
        
        if(!Yii::app()->getModule('user')->user()){
            return false;
        }        
        // parsing needed if urlFormat 'path'
        Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());

		// 1. get language preference
		$preferred = null;
		if (isset($_GET[$this->data_key])) {

			// use company from URL
			$preferred = $_GET[$this->data_key];

            //validate new comapny
            if(!$this->isValidUserCompany($preferred)){
                throw new CHttpException(404, "Company '{$_GET[$this->data_key ]}' is not available.");
            }

            //set new company as active
            $this->_setActiveCompany($preferred);

            return TRUE;

		} 
        
        if ($this->getActiveCompany()) {

			// use active company from profile.ccmp_id
			$preferred = $this->getActiveCompany();
            if($this->isValidUserCompany($preferred)){
                $this->_setActiveCompany($preferred);
                return TRUE;
            }
    	}

        //get first user company
        $a = $this->getClientCompanies();
        if(empty($a)){
            throw new CHttpException(404, "For user companies are not available.");
        }

        //set new company as active
        $this->_setActiveCompany($a[0]['ccmp_id']);

	}


    /**
     * load from user profile ccmp_id value
     * profile field name is in $this->profiles_ccmp_field
     * @return boolean
     */
    public function getActiveCompany(){
        //user model required
        if(!Yii::app()->hasModule('user')){
            return false;
        }        
        if($this->_activeCompany){
            return $this->_activeCompany;
        }
        
        if(Yii::app()->user->isGuest){
            return false;
        }

        if(!Yii::app()->getModule('user')->user()){
            return false;
        }
        $cmmp_id = Yii::app()->getModule('user')->user()->profile->{$this->profiles_ccmp_field};

        if(!$cmmp_id){
            return FALSE;
        }
        $this->_activeCompany = $cmmp_id;
        return $this->_activeCompany;
    }

    public function getActiveCompanyName(){
            return $this->_activeCompanyName;
    }

     /**
      * get all client companies
      * @return array
      */
     public function getClientCompanies(){
         if($this->_aUserCompanies === FALSE){
            //$this->_aUserCompanies = CcucUserCompany::model()->getUserCompnies(Yii::app()->getModule('user')->user()->id,$this->ccuc_status);
                 $sql = "
                        SELECT 
                          ccmp_id,
                          ccmp_name 
                        FROM
                          ccuc_user_company 
                          INNER JOIN ccmp_company 
                            ON ccmp_id = ccuc_ccmp_id 
                        WHERE ccuc_person_id = ".Yii::app()->getModule('user')->user()->profile->person_id."
                          AND ccuc_status = '".$this->ccuc_status."' 
                    ";
            $this->_aUserCompanies = Yii::app()->db->createCommand($sql)->queryAll();            
         }
         return $this->_aUserCompanies;
     }

     
     /**
      * create array  of user companies id (ccmp_id)
      * @return array
      */
     public function getCompanyList(){
         $a = array();
         foreach($this->getClientCompanies() as $row){
             $a[] = $row['ccmp_id'];
         }
         return $a;
     }

     
     public function isValidUserCompany($ccmp_id){
         foreach($this->getClientCompanies() as $company){
             if($company['ccmp_id'] == $ccmp_id ){
                 return TRUE;
             }
         }

         return FALSE;
     }

     /**
      * colect active company data and set actice company in user prifle table
      * @param type $ccmp_id
      * @return boolean
      * @throws CHttpException
      */
     private function _setActiveCompany($ccmp_id){

         if(Yii::app()->getModule('user')->user()->profile->ccmp_id != $ccmp_id){
            //update 
            $sSql = "
                UPDATE profiles 
                SET ".$this->profiles_ccmp_field." = ".$ccmp_id." 
                WHERE 
                    user_id = ".Yii::app()->getModule('user')->user()->id
                ;
            Yii::app()->db->createCommand($sSql)->query();             
         }

         $this->_activeCompany = $ccmp_id;
         
         //set comapny name
         foreach($this->getClientCompanies() as $company){
             if($ccmp_id == $company['ccmp_id']){
                 //$this->_company_attributes =  array_merge( $company->ccucCcmp->attributes,$company->ccucCcmp->cccdCustomData->attributes);                 
                 $sql = "
                    SELECT 
                        * 
                    FROM
                        ccmp_company inner 
                        JOIN cccd_custom_data 
                          ON ccmp_id = cccd_ccmp_id 
                    WHERE ccmp_id = ".$ccmp_id."
                    ";
                 $this->_company_attributes = Yii::app()->db->createCommand($sql)->queryRow();
                 $this->_activeCompanyName = $this->_company_attributes['ccmp_name'];
                 return TRUE;
             }
         }
         throw new CHttpException(404, "For ccmp_id=".$ccmp_id. "neatrada nosaukumu");
     }

     /**
      * return active company table ccmp_company and cccd_custom_data record field values
      * @param type $atribute
      * @return type
      */
     public function getAttribute($atribute){
         return $this->_company_attributes[$atribute];
     }

     /**
      * chek user access
      * @param char $name auth item (role or ...)
      * @return boolean
      */
     public function checkUA($name){
         if(empty($this->_auth_items)){
             $this->getAuthItemChild();
         }
         return isset($this->_auth_items[$name]);
     }
     
     /**
      * load recursevly for current user all auth asigments in $this->_auth_items
      */
     private function getAuthItemChild(){
         
        //get user name
        $user_id = Yii::app()->getModule('user')->user()->id;

        $new = Yii::app()->db->createCommand()
           ->select('itemname child')
           ->from('authassignment')
           ->where('userid = :userid',array(':userid'=>$user_id))
           ->queryAll();             
         
         
         //init loop
         //$new[] = array('child' => $user_name);         
         $result = array();
         
         //load all leves uzth items
         while(!empty($new)){
             
            //create child list 
            $list = array(); 
            foreach ($new as $row){
                $list[] = $row['child'];
                
                //save result
                $result[$row['child']] = TRUE;
            }
             
            $new = Yii::app()->db->createCommand()
               ->select('child')
               ->from('authitemchild')
               ->where(array('in', 'parent', $list))
               ->queryAll();             
        }
        
        $this->_auth_items = $result;
         
     }
}