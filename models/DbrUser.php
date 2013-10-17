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

    /**
     * user all roles
     * @var array
     */
    private static $_aClientOfficeCompanies = FALSE;

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


     
     static public function getRoles() {
         if(self::$_aUserRoles === FALSE){
            self::$_aUserRoles = Rights::getAssignedRoles(Yii::app()->getModule('user')->user()->id);
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

     /**
      * get all client companies
      * @return array
      */
      static public function getOfficeClientCompanies(){
         if(self::$_aClientOfficeCompanies === FALSE){

            $criteria=new CDbCriteria;
            //$criteria->select='ccmp_id,ccmp_name';  // only select the 'title' column
            //$criteria->join = 'INNER JOIN ccmp_company ON ccuc_ccmp_id = ccmp_id';
            $criteria->condition='ccuc_user_id=:user_id';
            $criteria->params=array(':user_id' => Yii::app()->getModule('user')->user()->id);
            self::$_aClientOfficeCompanies  = CcucUserCompany::model()->findAll($criteria); // $params is not needed
         }
         return self::$_aClientOfficeCompanies;
     }
}

?>
