<?php

class m141122_085806_ccuc_alter extends EDbMigration
{
	public function up()
	{
        $this->execute("

        ALTER TABLE `ccuc_user_company`   
          CHANGE `ccuc_id` `ccuc_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT;

        ");        
	}

	public function down()
	{


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