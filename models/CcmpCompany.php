<?php

// auto-loading
Yii::setPathOfAlias('CcmpCompany', dirname(__FILE__));
Yii::import('CcmpCompany.*');

class CcmpCompany extends BaseCcmpCompany
{

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
             //auditrail       
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            ),
        ));
    }
    
    public function rules()
    {
        return array_merge(
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
        );
    }
    
    public function defaultScope()
    {
        return array(
            'condition'=>'ccmp_sys_ccmp_id = ' . Yii::app()->sysCompany->getActiveCompany(),
       );
    }
    
    public function userSysCompanyCompanies()
    {
        $this->getDbCriteria()->mergeWith(array(
                'condition'=>'t.ccmp_sys_ccmp_id = ' . Yii::app()->sysCompany->getActiveCompany(),
        ));
        return $this;
    }        
    
    public function getCssClass() {
        
      
        return "row-".strtolower($this->ccmp_statuss);
        
           
           
        
    }
    
    
    public function getManagers() {
        
       
        $mCcuc=$this->ccucUserCompany; 
        
        if (isset($mCcuc))
        foreach($mCcuc as $u)
        {
            $user = $u->ccucUsers;
            if (isset($user)) {
                $roles = $user->userroles; 
                 if (array_key_exists('Manager',$roles ))            $managers[]= $user->fullname;
            }
           
        }
        
        if (isset($managers)) return implode(',' ,$managers);
        else return " ";
        
    }

    public function findByGroup($ccgr_id){
        $criteria = new CDbCriteria;
        $criteria->join =' INNER JOIN ccxg_company_x_group ON ccmp_id = ccxg_ccmp_id ';        
        $criteria->addCondition('ccxg_ccgr_id = :ccgr_id');
        $criteria->params = array(':ccgr_id' => $ccgr_id);
        return $this->findAll($criteria);
    }
    
    
    public static function createCustomerUser($usermodel , $profilemodel, $ccmp_id){
        
         // user creation
        
          if (!$usermodel->validate())
                        throw new Exception('Username or email is not unique, try again or add manually');
          
          $pass = DbrLib::rand_string(8);
          $usermodel->password = UserModule::encrypting($pass);
          if ($usermodel->save()) {
                        
                        $profilemodel->user_id = $usermodel->id;
                        $profilemodel->save();

                        // role assignment Customer
                        //assign role
                        $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
                        $authorizer->authManager->assign('CustomerOffice', $usermodel->id);


                        //company user
                        $companyuser = new CcucUserCompany;
                        $companyuser->ccuc_ccmp_id = $ccmp_id;
                        $companyuser->ccuc_user_id = $usermodel->id;
                        if ($companyuser->validate())
                            $companyuser->save();
                  
              
                    }
                
       return $pass; 
    }
    
    public function save($runValidation = true, $attributes = NULL) 
    {
        //set system company id
        if ($this->isNewRecord && Yii::app()->sysCompany->getActiveCompany()){
            $this->ccmp_sys_ccmp_id = Yii::app()->sysCompany->getActiveCompany();
        }              

        return parent::save($runValidation,$attributes);

    }    
}
