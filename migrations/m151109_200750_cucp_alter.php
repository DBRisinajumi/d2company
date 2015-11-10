<?php

class m151109_200750_cucp_alter extends EDbMigration
{
	public function up()
	{
            $sql = "
                ALTER TABLE `cucp_user_company_position`   
                    CHANGE `cucp_name` `cucp_name` VARCHAR(100) CHARSET utf8 COLLATE utf8_general_ci NOT NULL;
            ";
	}

	public function down()
	{
		echo "m151109_200750_cucp_alter does not support migration down.\n";
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