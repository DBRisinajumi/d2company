<?php
 
class m141006_183210_auth_CcbrBranch extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcbrBranch.*','0','D2company.CcbrBranch',NULL,'N;')  on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcbrBranch.Create','0','D2company.CcbrBranch module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcbrBranch.View','0','D2company.CcbrBranch module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcbrBranch.Update','0','D2company.CcbrBranch module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcbrBranch.Delete','0','D2company.CcbrBranch module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcbrBranch.*';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcbrBranch.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcbrBranch.View';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcbrBranch.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2company.CcbrBranch.Delete';
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


