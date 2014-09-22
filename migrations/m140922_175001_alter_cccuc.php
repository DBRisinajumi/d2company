<?php
/**
 * full migration
 */

class m140922_175001_alter_cccuc extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        $this->execute("

            CREATE TABLE `cucp_user_company_position`(  
              `cucp_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
              `cucp_name` VARCHAR(20) NOT NULL,
              PRIMARY KEY (`cucp_id`)
            ) ENGINE=INNODB CHARSET=utf8;
            
            ALTER TABLE `ccuc_user_company`  
                CHANGE `ccuc_ccmp_id` `ccuc_ccmp_id` INT(10) UNSIGNED NULL,
                ADD COLUMN `ccuc_cucp_id` TINYINT UNSIGNED NULL AFTER `ccuc_status`,
                ADD FOREIGN KEY (`ccuc_cucp_id`) REFERENCES `cucp_user_company_position`(`cucp_id`);
        ");
    }

    /**
	 * Drops the table
	 */
    public function down()
    {
        $this->execute("

        ");
    }

    /**
	 * Creates initial version of the table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
    public function safeUp()
    {
        $this->up();
    }

    /**
	 * Drops the table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
    public function safeDown()
    {
        $this->down();
    }
}
