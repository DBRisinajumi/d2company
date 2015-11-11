<?php
 
class m151110_204711_auth_CucpUserCompanyPosition extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.*','0','D2company.CucpUserCompanyPosition',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.Create','0','D2company.CucpUserCompanyPosition module create',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.View','0','D2company.CucpUserCompanyPosition module view',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.Update','0','D2company.CucpUserCompanyPosition module update',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.Delete','0','D2company.CucpUserCompanyPosition module delete',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CucpUserCompanyPosition.Menu','0','D2company.CucpUserCompanyPosition show menu',NULL,'N;');
                

        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.*';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.Create';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.View';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.Update';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.Delete';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CucpUserCompanyPosition.Menu';

        ");
    }

    public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }
}


