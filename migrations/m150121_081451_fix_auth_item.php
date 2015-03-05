<?php

class m150121_081451_fix_auth_item extends EDbMigration
{
	public function up()
	{
        $this->execute("
            UPDATE `AuthItem` 
            SET `description` = 'D2company.CcmpCompany module menu' 
            WHERE `name` = 'D2company.CcmpCompany.Menu'; 
        ");          
	}

	public function down()
	{
		echo "m150121_081451_fix_auth_item does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}