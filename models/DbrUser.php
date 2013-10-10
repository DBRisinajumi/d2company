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
}

?>
