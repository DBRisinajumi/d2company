<?php
/**
 * full migration
 */

class m141003_202001_alter_ccxg extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        $this->execute("
            ALTER TABLE `ccxg_company_x_group`   
              CHANGE `ccxg_ccgr_id` `ccxg_ccgr_id` TINYINT(3) UNSIGNED NULL;
            ALTER TABLE `ccuc_user_company`   
                CHANGE `ccuc_person_id` `ccuc_person_id` SMALLINT(11) UNSIGNED NULL,
                CHANGE `ccuc_status` `ccuc_status` ENUM('USER','HIDDED','PERSON','SYS') CHARSET ASCII COLLATE ascii_general_ci DEFAULT 'PERSON'   NULL;              


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
