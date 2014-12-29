<?php

class m141229_072229_ccmp_name_unique_remove extends EDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE `ccmp_company`   
                DROP INDEX `ccmp_name_UNIQUE`,
                ADD  INDEX `ccmp_name_UNIQUE` (`ccmp_name`(4));
        ");        
	}

	public function down()
	{
		echo "m141229_072229_ccmp_name_unique_remove does not support migration down.\n";
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