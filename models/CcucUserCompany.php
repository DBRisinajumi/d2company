<?php

// auto-loading
Yii::setPathOfAlias('CcucUserCompany', dirname(__FILE__));
Yii::import('CcucUserCompany.*');

class CcucUserCompany extends BaseCcucUserCompany
{
    // for search
    public $pprs_second_name;
    public $pprs_first_name;
    public $ccmp_name;
    public $itemname;

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
                'ccucCcmp' => array(self::BELONGS_TO, 'CcmpCompanyAll', 'ccuc_ccmp_id'),
                'ccucPerson' => array(self::BELONGS_TO, 'PprsPerson', 'ccuc_person_id'),
            )
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('pprs_second_name,pprs_first_name,ccmp_name,itemname', 'safe', 'on' => 'search'),
            )
        );
    }
    
    public function attributeLabels() {
        return array_merge(
                parent::attributeLabels(), array(
            'pprs_second_name' => Yii::t('D2companyModule.crud', 'Second Name'),
            'pprs_first_name' => Yii::t('D2companyModule.crud', 'First Name'),
            'ccmp_name' => Yii::t('D2companyModule.crud', 'Company Name'),
            'itemname' => Yii::t('D2companyModule.crud', 'Role'),
        ));
    }

    public function search()
    {
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria(),
        ));
    }

    public function searchPersons()
    {
        //$this->ccuc_status = self::CCUC_STATUS_PERSON;
        
        $criteria = new CDbCriteria;        
        $criteria->select = '
                ccuc_person_id,
                ccmp_company.ccmp_name, 
                pprs_person.pprs_second_name,
                pprs_person.pprs_first_name,
                authassignment.itemname ';        
        
        $criteria->join  = " 
                INNER JOIN ccmp_company 
                    ON ccuc_ccmp_id = ccmp_id 
                INNER JOIN pprs_person
                    ON ccuc_person_id = pprs_id                     
                LEFT OUTER JOIN `profiles`
                    ON ccuc_person_id = `profiles`.person_id 
                LEFT OUTER JOIN `authassignment`
                    ON `profiles`.user_id  = authassignment.userid 
            ";
        
        $criteria->compare('pprs_status',  PprsPerson::PPRS_STATUS_ACTIVE);
        $criteria->compare('pprs_second_name',$this->pprs_second_name,true);
        $criteria->compare('pprs_first_name',$this->pprs_first_name,true);
        $criteria->compare('ccmp_name',$this->ccmp_name,true);
        $criteria->compare('itemname',$this->itemname);
        $criteria->compare('ccmp_sys_ccmp_id',Yii::app()->sysCompany->getActiveCompany());

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
        ));
    }
    
    /**
     * get user companies by user and status
     * @param type $user_id
     * @param type $status
     * @return type
     */
    public function getUserCompnies($user_id,$status) {
        $criteria = new CDbCriteria;
        $criteria->join .= "INNER JOIN profiles p  ON p.person_id = ccuc_person_id AND ccuc_status='" . $status . "'";
        $criteria->condition = 'p.user_id = ' . $user_id;
        return CcucUserCompany::model()->findAll($criteria);
    }
    
}
