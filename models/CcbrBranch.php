<?php

// auto-loading
Yii::setPathOfAlias('CcbrBranch', dirname(__FILE__));
Yii::import('CcbrBranch.*');

class CcbrBranch extends BaseCcbrBranch
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
        if(empty($this->ccbrCcmp)){
            return (string)'';
        }
        return (string) $this->ccbrCcmp->ccmp_name . ' ' . $this->ccbr_name ;
    }

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
             //auditrail       
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            )
        ));
    }
    
    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'ccbrCcmp' => array(self::BELONGS_TO, 'CcmpCompanyAll', 'ccbr_ccmp_id'),
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

}
