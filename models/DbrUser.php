<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DbrUser extends User
{
    
     public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
     public function getFullName() {return $this->profile->first_name." ".$this->profile->last_name; }
     public function getFullNameUsername() {return $this->profile->first_name." ".$this->profile->last_name." (".$this->username.")"; }
     
     public function getFullNameUsernameRoles() {
       
         $roles=Rights::getAssignedRoles($this->id);
         $rolestring=array();
         foreach($roles as $role)
         {
             $rolestring[] = $role->name;
         }
         return $this->getFullNameUsername()." Roles:".implode(",", $rolestring);

     }
}

?>
