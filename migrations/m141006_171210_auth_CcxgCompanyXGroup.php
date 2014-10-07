<?php
 
class m141006_171210_auth_CcxgCompanyXGroup extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcxgCompanyXGroup.*','0','D2company.CcxgCompanyXGroup',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcxgCompanyXGroup.Create','0','D2company.CcxgCompanyXGroup module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcxgCompanyXGroup.View','0','D2company.CcxgCompanyXGroup module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcxgCompanyXGroup.Update','0','D2company.CcxgCompanyXGroup module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcxgCompanyXGroup.Delete','0','D2company.CcxgCompanyXGroup module delete',NULL,'N;');
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcxgCompanyXGroup.*';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcxgCompanyXGroup.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcxgCompanyXGroup.View';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcxgCompanyXGroup.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcxgCompanyXGroup.Delete';
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


