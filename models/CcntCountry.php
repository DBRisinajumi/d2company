<?php

// auto-loading
Yii::setPathOfAlias('CcntCountry', dirname(__FILE__));
Yii::import('CcntCountry.*');

class CcntCountry extends BaseCcntCountry
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
            )
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
    
    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
             'sort'=>array('defaultOrder'=>'ccnt_name'),
             'pagination'=>array('pageSize'=>50),
            
        ));
    }  

}
