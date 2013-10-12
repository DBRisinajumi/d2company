
<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        switch ($this->action->id) {
            case "create":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
                break;
            case "admin":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Create"),
                    "icon" => "icon-plus",
                    "url" => array("create"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Create")
                ));
                  $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Export"),
                    "url" => array("admin","export" => " xls"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Export"),
                     "htmlOptions"=>array("class"=>"export-button")
                ));
        //         $this->widget("bootstrap.widgets.TbButton",
        //           array("label"=>Yii::t('d2companyModule.crud_static','Search'),
        //        "icon"=>"icon-search",
        //        "htmlOptions"=>array("class"=>"search-button")
        //       ));
                 
                break;
            case "view":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Update"),
                    "icon" => "icon-edit",
                    "url" => array("update", "ccmp_id" => $model->{$model->tableSchema->primaryKey}),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Update")
                ));
//                    $this->widget("bootstrap.widgets.TbButton", array(
//                        "label"=>Yii::t("d2companyModule.crud_static","Create"),
//                        "icon"=>"icon-plus",
//                        "url"=>array("create"),
//                        "visible"=>Yii::app()->user->checkAccess("D2company.CcmpCompany.Create")
//                    ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "ccmp_id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("d2companyModule.crud_static", "Do you want to delete this item?")
                    ),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Delete")
                ));
                break;
            case "update":
            case "updateccbr":
            case "manageccbr":
            case "updategroup":
            case "createccbr":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
//                    $this->widget("bootstrap.widgets.TbButton", array(
//                        "label"=>Yii::t("d2companyModule.crud_static","View"),
//                        "icon"=>"icon-eye-open",
//                        "url"=>array("view","ccmp_id"=>$model->{$model->tableSchema->primaryKey}),
//                        "visible"=>Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
//                    ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("d2companyModule.crud_static", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "ccmp_id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("d2companyModule.crud_static", "Do you want to delete this item?")
                    ),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Delete")
                ));
                break;
        }
        ?>    </div>
</div>
 

