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
class userCompanyHandler extends CApplicationComponent
{
    /**
     * $_GET param used for language detection
     */
    const DATA_KEY = 'company';
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
    /**
     * Handles company detection and application setting by URL parm specified in DATA_KEY
     */
    public function init()
    {
        // parsing needed if urlFormat 'path'
        Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());

		// 1. get language preference
		$preferred = null;
		if (isset($_GET[self::DATA_KEY])) {

			// use company from URL
			$preferred = $_GET[self::DATA_KEY];

            //validate new comapny
            if(!$this->_isValidClientCompany($preferred)){
                throw new CHttpException(404, "Company '{$_GET[self::DATA_KEY]}' is not available.");
            }

            //set new company as active
            $this->_setActiveCompany($preferred);

            return TRUE;

		} 
        
        if ($this->getActiveCompany()) {

			// use active company from profile.ccmp_id
			$preferred = $this->getActiveCompany();
            if($this->_isValidClientCompany($preferred)){
                $this->_setActiveCompany($preferred);
                return TRUE;
            }
    	}

        //get first user company
        $a = $this->getOfficeClientCompanies();
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
        //var_dump(Yii::app()->user);exit;
        //$cmmp_id = Yii::app()->user->profile->ccmp_id;
        $cmmp_id = Yii::app()->getModule('user')->user()->profile->ccmp_id;
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
     public function getOfficeClientCompanies(){
         if($this->_aUserCompanies === FALSE){

            $criteria=new CDbCriteria;
            $criteria->condition='ccuc_user_id=:user_id';
            $criteria->params=array(':user_id' => Yii::app()->getModule('user')->user()->id);
            $this->_aUserCompanies  = CcucUserCompany::model()->findAll($criteria); // $params is not needed
         }
         return $this->_aUserCompanies;
     }

     private function _isValidClientCompany($ccmp_id){
         foreach($this->getOfficeClientCompanies() as $company){
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
                SET ccmp_id = ".$ccmp_id." 
                WHERE 
                    user_id = ".Yii::app()->getModule('user')->user()->id
                ;
            Yii::app()->db->createCommand($sSql)->query();             
         }

         $this->_activeCompany = $ccmp_id;
         
         //set comapny name
         foreach($this->getOfficeClientCompanies() as $company){
             if($ccmp_id == $company->ccuc_ccmp_id){
                 $this->_activeCompanyName = $company->ccucCcmp->ccmp_name;
                 return TRUE;
             }
         }
         throw new CHttpException(404, "For ccmp_id=".$ccmp_id. "neatrada nosaukumu");
     }

}

?>