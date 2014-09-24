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
    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'cccdCustomData' => array(self::HAS_ONE, 'BaseCccdCompanyData', 'cccd_ccmp_id'),
                'bcbdCompanyBranchDays' => array(self::HAS_MANY, 'BcbdCompanyBranchDay', 'bcbd_client_ccmp_id'), 
                'bcars' => array(self::HAS_MANY, 'BcarId', 'bcar_ccmp_id'),
            ));
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
    
    
    public static function createCustomerUser($usermodel, $profilemodel, $ccmp_id) {

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
    
   protected function beforeFind()
   {
        //get defined user positions in companies
        $sql = " 
            SELECT DISTINCT 
              cucp_id 
            FROM
              authitem ai 
              INNER JOIN cucp_user_company_position 
                ON ai.name = cucp_role 
              INNER JOIN authassignment aa 
                ON ai.name = aa.itemname 
            WHERE aa.userid = ".Yii::app()->user->id."                 
                ";
        $user_def_company_positions = Yii::app()->db->createCommand($sql)->queryAll();
        
        $criteria = false;
        if($user_def_company_positions){
           
            $udcp = array();
            foreach($user_def_company_positions as $v){
                $udcp[] = $v['cucp_id'];
            }
            //get companies, where is user positions
            $sql = " 
                SELECT DISTINCT 
                    ccuc_ccmp_id 
                FROM
                ccuc_user_company 
                WHERE ccuc_cucp_id in (".implode(',',$udcp).") 
                    AND ccuc_person_id = ".Yii::app()->getModule('user')->user()->profile->person_id."                 
                    AND ccuc_status = '".CcucUserCompany::CCUC_STATUS_PERSON."'
                    ";
            $user_companies = Yii::app()->db->createCommand($sql)->queryAll();            

            //add to criteria user companies
            if(!$criteria){
                $criteria = new CDbCriteria;
            }            
            $uc = array();
            $uc[] = 0; //for avoiding error if empty user company list
            foreach($user_companies as $v){
                $uc[] = $v['ccuc_ccmp_id'];
            }            

            $criteria->compare('ccmp_id', $uc);
        }
       
        //filter by syscomapny
        
        if( Yii::app()->hasComponent('sysCompany') && Yii::app()->sysCompany->getActiveCompany()){
            if(!$criteria){
                $criteria = new CDbCriteria;
            }
            $criteria->compare('ccmp_sys_ccmp_id', Yii::app()->sysCompany->getActiveCompany());
        }
        
        if($criteria){
            $this->dbCriteria->mergeWith($criteria);
        }
        
        parent::beforeFind();
    }    
    
    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
       
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
             'sort'=>array('defaultOrder'=>'ccmp_name'),
             'pagination'=>array('pageSize'=>50),

        ));        
    } 
  
   
    
}
