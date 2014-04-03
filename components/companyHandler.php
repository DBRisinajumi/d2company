<?php

/**
 * Class File
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


    /**
     * Handles company detection and application setting by URL parm specified in DATA_KEY
     */
    public function init()
    {
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
        $mCcuc = $a[0];
        $preferred = $mCcuc->ccuc_ccmp_id;

        //set new company as active
        $this->_setActiveCompany($preferred);
        

	}

    public function getActiveCompany(){
        if($this->_activeCompany){
            return $this->_activeCompany;
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
            $this->_aUserCompanies = CcucUserCompany::model()->getUserCompnies(Yii::app()->getModule('user')->user()->id,$this->ccuc_status);
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
             $a[] = $row->ccuc_ccmp_id;
         }
         return $a;
     }

     
     public function isValidUserCompany($ccmp_id){
         foreach($this->getClientCompanies() as $company){
             if($company->ccuc_ccmp_id == $ccmp_id ){
                 return TRUE;
             }
         }

         return FALSE;
     }

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
             if($ccmp_id == $company->ccuc_ccmp_id){
                 $this->_activeCompanyName = $company->ccucCcmp->ccmp_name;
                 return TRUE;
             }
         }
         throw new CHttpException(404, "For ccmp_id=".$ccmp_id. "neatrada nosaukumu");
     }

}