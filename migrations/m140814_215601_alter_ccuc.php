<?php

class m140814_215601_alter_ccuc extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("
        ALTER TABLE `ccuc_user_company`   
            CHANGE `ccuc_ccmp_id` `ccuc_ccmp_id` INT(10) UNSIGNED NULL;

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
