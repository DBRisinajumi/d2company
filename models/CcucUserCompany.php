<?php

// auto-loading
Yii::setPathOfAlias('CcucUserCompany', dirname(__FILE__));
Yii::import('CcucUserCompany.*');

class CcucUserCompany extends BaseCcucUserCompany
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

    public function search()
    {
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria(),
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
