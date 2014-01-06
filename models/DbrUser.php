<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DbrUser extends User
{

    /**
     * role name for Client Office
     */
    const RoleCustomerOffice = 'CustomerOffice';

    /**
     * user all roles
     * @var array
     */
    private static $_aUserRoles = FALSE;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
     public function getFullName() {
         return $this->profile->first_name." ".$this->profile->last_name; 
         
     }
     
     public function getFullNameUsername() {
         return $this->profile->first_name." ".$this->profile->last_name." (".$this->username.")"; 
     }

     public function getActiveCompany() {
         return $this->profile->ccmp_id; }
     
     public function getFullNameUsernameRoles() {
       
         $roles=Rights::getAssignedRoles($this->id);
         $rolestring=array();
         foreach($roles as $role)
         {
             $rolestring[] = $role->name;
         }
         return $this->getFullNameUsername()." Roles:".implode(",", $rolestring);

     }


     
     static  function getRoles() {
         if(self::$_aUserRoles === FALSE && isset(Yii::app()->getModule('user')->user()->id)){
            self::$_aUserRoles = Rights::getAssignedRoles(Yii::app()->getModule('user')->user()->id);
        
         }
         return   self::$_aUserRoles;
        
     }
     
     public  function getUserRoles() {
         
        return           Rights::getAssignedRoles($this->id);
         
         
        
     }

     /**
      * verify has role OfficeUser
      * @return boolean
      */
     static public function isCustomerOfficeUser(){
         if(Yii::app()->user->isGuest){
             return FALSE;
         }
         $a = self::getRoles();
         return isset($a[self::RoleCustomerOffice]);
     }
          
}