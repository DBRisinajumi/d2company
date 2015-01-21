<?php

// auto-loading
Yii::setPathOfAlias('CcmpCompany', dirname(__FILE__));
Yii::import('CcmpCompany.*');


class CcmpCompany extends BaseCcmpCompany
{
    //for filter
    public $ccxg_ccgr_id;
    
    //for list
    public $ccgr_name;
    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccxg_ccgr_id', 'safe', 'on' => 'search'),
            )
        );
    }    
    
    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function getNameAsFirstUpperCase()
    {
        if(empty($this->ccmp_name)){
            return '';
        }
        $a = explode(' ', $this->ccmp_name);
        $name =  '';
        foreach($a as $s){
                $name .= $s[0];
        }

        return $name;
    }

    
    
    public function behaviors() {
        
        $behaviors = parent::behaviors();
        
        //auditrail  
        if(isset(Yii::app()->getModule('d2company')->options['audittrail']) 
            && Yii::app()->getModule('d2company')->options['audittrail'])
        { 
            $behaviors = array_merge(
                $behaviors, array(
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            ),
        ));            
        }
        
        return $behaviors;
    }
    
    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'cccdCustomData' => array(self::HAS_ONE, 'BaseCccdCompanyData', 'cccd_ccmp_id'),
                //'bcbdCompanyBranchDays' => array(self::HAS_MANY, 'BcbdCompanyBranchDay', 'bcbd_client_ccmp_id'), 
                //'bcars' => array(self::HAS_MANY, 'BcarId', 'bcar_ccmp_id'),
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
        if(empty($this->ccmp_statuss)){
            return '';
        }
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

    public function beforeSave()
    {
        
        //validate acces rights
        if(!$this->isNewRecord && !CcmpCompany::model()->findByPk($this->primaryKey)){
            return false;
        }
        
        if(!parent::beforeSave()){
            return false;
        }
        
        return true;
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
       //spec defined access to companies 
       $uc = false;
       
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
            $uc = array();
            $uc[] = 0; //for avoiding error if empty user company list
            foreach($user_companies as $v){
                $uc[] = $v['ccuc_ccmp_id'];
            }            

        }
       
        if(Yii::app()->getModule('d2company')->access){
            
            $user_roles = Authassignment::model()->getUserRoles(Yii::app()->user->id);
            foreach(Yii::app()->getModule('d2company')->access as $access){
                
                //validate roles
                $intersect = array_intersect($user_roles,$access['roles']);
                if(empty($intersect)){
                    continue;
                }                
                
                //get group companies
                $sql = " 
                        SELECT 
                            ccxg_ccmp_id 
                        FROM 
                            ccxg_company_x_group 
                        WHERE 
                            ccxg_ccgr_id IN (".implode(',',$access['ccgr_id']).")";
                            
                $ccmp_id_list = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(!empty($ccmp_id_list)){
                    if($uc === false){
                        $uc = array();
                        $uc[] = 0; //for avoiding error if empty user company list
                    }                    
                    foreach($ccmp_id_list as $row){
                        $uc[] = $row['ccxg_ccmp_id'];
                    }
                }
            }
            
            
        }
        
        if($uc !== false){
            if(!$criteria){
                $criteria = new CDbCriteria;
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

    /**
     * special search for company list. Main model:CcxgCompanyXGroup
     * @param CDbCriteria $criteria
     * @return \CActiveDataProvider
     */
    public function searchForList($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->select = "t.*,ccgr_name,ccxg_ccgr_id";
        $criteria->compare('ccmp_id', $this->ccmp_id);
        $criteria->compare('ccmp_name', $this->ccmp_name, true);
        $criteria->compare('ccmp_ccnt_id', $this->ccmp_ccnt_id);
        $criteria->compare('ccmp_registrtion_no', $this->ccmp_registrtion_no, true);
        $criteria->compare('ccmp_vat_registrtion_no', $this->ccmp_vat_registrtion_no, true);
        $criteria->compare('ccmp_registration_date', $this->ccmp_registration_date);
        $criteria->compare('ccmp_registration_address', $this->ccmp_registration_address, true);
        $criteria->compare('ccmp_official_ccit_id', $this->ccmp_official_ccit_id);
        $criteria->compare('ccmp_official_address', $this->ccmp_official_address, true);
        $criteria->compare('ccmp_official_zip_code', $this->ccmp_official_zip_code, true);
        $criteria->compare('ccmp_office_ccit_id', $this->ccmp_office_ccit_id);
        $criteria->compare('ccmp_office_address', $this->ccmp_office_address, true);
        $criteria->compare('ccmp_office_zip_code', $this->ccmp_office_zip_code, true);
        $criteria->compare('ccmp_statuss', $this->ccmp_statuss);
        $criteria->compare('ccmp_description', $this->ccmp_description, true);
        $criteria->compare('ccmp_office_phone', $this->ccmp_office_phone, true);
        $criteria->compare('ccmp_office_email', $this->ccmp_office_email, true);
        $criteria->compare('ccmp_agreement_nr', $this->ccmp_agreement_nr, true);
        $criteria->compare('ccmp_agreement_date', $this->ccmp_agreement_date);
        $criteria->compare('ccmp_sys_ccmp_id', $this->ccmp_sys_ccmp_id);        
        $criteria->compare('ccxg_ccgr_id', $this->ccxg_ccgr_id);        

        $criteria->join  = " 
        LEFT OUTER JOIN ccxg_company_x_group 
            ON ccxg_ccmp_id = ccmp_id 
        LEFT OUTER JOIN ccgr_group 
            ON ccxg_ccgr_id = ccgr_id 
                   
        ";

        return new CActiveDataProvider('CcmpCompany', array(
            'criteria' => $criteria,
             'sort'=>array('defaultOrder'=>'ccmp_name'),
             'pagination'=>array('pageSize'=>50),

        ));        
    } 
  
    protected function afterSave()
    {
        
        if(empty($this->cccdCustomData)){
            // new Custom Data record, always must be
            $custom = new BaseCccdCompanyData;
            $custom->cccd_ccmp_id = $this->ccmp_id;
            $custom->save();
        }
        
        if(Yii::app()->getModule('d2company')->on_create){
            $on_create = Yii::app()->getModule('d2company')->on_create;
 
            $user_roles = Authassignment::model()->getUserRoles(Yii::app()->user->id);
            $user_roles[] = '*'; //all roles

            if(isset($on_create['add_ccuc']) && empty($this->ccucUserCompany)){
            
                //add ccuc (User company record)
                $pprs_id = Yii::app()->getModule('user')->user()->profile->person_id;
                foreach($on_create['add_ccuc'] as $rule){
                    
                    //has user in rule defined role?
                    $intersect = array_intersect($user_roles,$rule['roles']);
                    if(empty($intersect)){
                        continue;
                    }                
                    
                    foreach($rule['cucp_id'] as $cucp_id){
                        $ccuc = new CcucUserCompany();
                        $ccuc->ccuc_ccmp_id = $this->ccmp_id;
                        $ccuc->ccuc_person_id = $pprs_id;
                        $ccuc->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;
                        $ccuc->ccuc_cucp_id = $cucp_id;
                        $ccuc->save();
                    }

                    
                }
            }
            
            if(isset($on_create['add_ccxg']) && empty($this->ccxgCompanyXGroups)){
            
                //add ccxg (User company record)
                foreach($on_create['add_ccxg'] as $rule){
                    
                    //has user in rule defined role?
                    $intersect = array_intersect($user_roles,$rule['roles']);
                    if(empty($intersect)){
                        continue;
                    }                
                    
                    foreach($rule['ccgr_id'] as $ccgr_id){
                        $ccxg = new CcxgCompanyXGroup();
                        $ccxg->ccxg_ccmp_id = $this->ccmp_id;
                        $ccxg->ccxg_ccgr_id = $ccgr_id;
                        $ccxg->save();
                    }

                    
                }
            }
        }
        
        parent::afterSave();
    }
    
    /**
     * get all syscomanies array without access control
     * @param int $ccgr_id
     * @return array [
     *      ['ccmp_id' => 1, ccmp_name=>'company name1'],
     *      ['ccmp_id' => 2, ccmp_name=>'company name2'],
     * ]
     */
    public static function getAllGroupCompanies($ccgr_id) {
        $sql = "
              SELECT 
                ccmp_id,
                ccmp_name 
              FROM
                ccxg_company_x_group 
                INNER JOIN ccmp_company 
                  ON ccxg_ccmp_id = ccmp_id 
              WHERE ccxg_ccgr_id = :ccgr_id
              ORDER BY ccmp_name
            ";
        return Yii::app()->db
                        ->createCommand($sql)
                        ->bindParam(":ccgr_id", $ccgr_id, PDO::PARAM_INT)
                        ->queryAll();
    }

}
