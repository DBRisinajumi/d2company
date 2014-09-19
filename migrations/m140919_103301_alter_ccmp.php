<?php
/**
 * full migration
 */

class m140919_103301_alter_ccmp extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        $this->execute("

        ALTER TABLE `ccmp_company`   
            ADD COLUMN `ccmp_registration_date` DATE NULL AFTER `ccmp_vat_registrtion_no`,
            CHANGE `ccmp_office_phone` `ccmp_office_phone` VARCHAR(45) CHARSET utf8 COLLATE utf8_general_ci NULL,
            CHANGE `ccmp_office_email` `ccmp_office_email` VARCHAR(100) CHARSET utf8 COLLATE utf8_general_ci NULL;
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
