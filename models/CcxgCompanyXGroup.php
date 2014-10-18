<?php

// auto-loading
Yii::setPathOfAlias('CcxgCompanyXGroup', dirname(__FILE__));
Yii::import('CcxgCompanyXGroup.*');

class CcxgCompanyXGroup extends BaseCcxgCompanyXGroup
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
                'ccxgCcgr' => array(self::BELONGS_TO, 'CcgrGroup', 'ccxg_ccgr_id'),
                'ccxgCcmp' => array(self::BELONGS_TO, 'CcmpCompanyAll', 'ccxg_ccmp_id'),
            )
        );
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

    public function beforeSave()
    {
    
        //can not set syscomany, if no admin
        if($this->ccxg_ccgr_id == Yii::app()->params['ccgr_group_sys_company']
                && !Yii::app()->user->checkAccess("Administrator"))
        {
            return false;
        }
        
        return parent::beforeSave();

    }    
    
    protected function afterSave()
    {
        parent::afterSave();
        
        //if added syscomany group, add company as SYS to person in ccuc
        if(isset(Yii::app()->params['ccgr_group_sys_company']) 
                && $this->ccxg_ccgr_id == Yii::app()->params['ccgr_group_sys_company'])
        {
            $ccuc = new CcucUserCompany();
            $ccuc->ccuc_ccmp_id = $this->ccxg_ccmp_id;
            $ccuc->ccuc_person_id = Yii::app()->getModule('user')->user()->profile->person_id;
            $ccuc->ccuc_status = CcucUserCompany::CCUC_STATUS_SYS;
            $ccuc->save();
        }        
    }
    
}
