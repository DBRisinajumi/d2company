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

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );    }

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
    
    public function searchCustomers()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ccuc_id',$this->ccuc_id);
		$criteria->compare('ccuc_ccmp_id',$this->ccuc_ccmp_id);
		$criteria->compare('ccuc_user_id',$this->ccuc_user_id);
                
                $criteria->join = 'INNER JOIN authassignment ON ccuc_user_id = userid';
                $criteria->addCondition("itemname = 'CustomerOffice'");
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
