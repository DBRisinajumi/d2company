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
    const RoleClientOffice = 'ClientOffice';

    /**
     * user all roles
     * @var array
     */
    private static $_aUserRoles = FALSE;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
     public function getFullName() {return $this->profile->first_name." ".$this->profile->last_name; }
     public function getFullNameUsername() {return $this->profile->first_name." ".$this->profile->last_name." (".$this->username.")"; }

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


     
     public function getRoles() {
         if(self::$_aUserRoles === FALSE){
         //   self::$_aUserRoles = Rights::getAssignedRoles(Yii::app()->getModule('user')->user()->id);
             self::$_aUserRoles = Rights::getAssignedRoles($this->id);
         }
         return   self::$_aUserRoles;
        
     }

     /**
      * verify has role ClientOffice
      * @return boolean
      */
     static public function isOfficeClient(){
         if(Yii::app()->user->isGuest){
             return FALSE;
         }
         $a = self::getRoles();
         return isset($a[self::RoleClientOffice]);
     }

}