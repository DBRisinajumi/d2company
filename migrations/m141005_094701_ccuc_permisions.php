<?php
/**
 * full migration
 */

class m141005_094701_ccuc_permisions extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`) VALUES ('D2company.CcucUserCompany.*', '0', 'D2company.CcucUserCompany.*');                 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('Company.edit', 'D2company.CcucUserCompany.*'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('Company.fullcontrol', 'D2company.CcucUserCompany.*'); 
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
