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
                'class' => 'vendor.sammaye.audittrail.behaviors.LoggableBehavior'
            ),
                    
             // remember grid filter       
            'ERememberFiltersBehavior' => array(
               'class' => 'application.components.ERememberFiltersBehavior',
               'defaults'=>array(),           /* optional line */
               'defaultStickOnClear'=>false   /* optional line */
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
        foreach($mCcuc as $user)
        {
            $roles = $user->ccucUsers->roles; 
            if (array_key_exists('Manager',$roles ))
                $managers[]= $user->ccucUsers->fullname;
        }
        
        if (isset($managers)) return implode(',' ,$managers);
        else return "";
        
    }

}
