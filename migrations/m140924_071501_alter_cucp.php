<?php
/**
 * full migration
 */

class m140924_071501_alter_cucp extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        $this->execute("

           ALTER TABLE `cucp_user_company_position`   
              ADD COLUMN `cucp_role` CHAR(20) NULL AFTER `cucp_name`;

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
