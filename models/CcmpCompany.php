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
//        
//
//
//        
//        $sql = "
//            SELECT 
//                ccmp_company.*
//              FROM
//                ccmp_company 
//                INNER JOIN ccxg_company_x_group 
//                  ON ccxg_ccmp_id = ccmp_id 
//              WHERE ccxg_ccgr_id = ".$group."
//              ORDER BY ccmp_name 
//                ";
//        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
}
