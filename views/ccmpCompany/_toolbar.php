
<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        switch ($this->action->id) {
            case "create":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
                break;
            case "admin":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Create"),
                    "icon" => "icon-plus",
                    "url" => array("create"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Create")
                ));
                break;
            case "view":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Update"),
                    "icon" => "icon-edit",
                    "url" => array("update", "ccmp_id" => $model->{$model->tableSchema->primaryKey}),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Update")
                ));
//                    $this->widget("bootstrap.widgets.TbButton", array(
//                        "label"=>Yii::t("crud","Create"),
//                        "icon"=>"icon-plus",
//                        "url"=>array("create"),
//                        "visible"=>Yii::app()->user->checkAccess("D2company.CcmpCompany.Create")
//                    ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "ccmp_id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("crud", "Do you want to delete this item?")
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
                    "label" => Yii::t("crud", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                ));
//                    $this->widget("bootstrap.widgets.TbButton", array(
//                        "label"=>Yii::t("crud","View"),
//                        "icon"=>"icon-eye-open",
//                        "url"=>array("view","ccmp_id"=>$model->{$model->tableSchema->primaryKey}),
//                        "visible"=>Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
//                    ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("crud", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "ccmp_id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("crud", "Do you want to delete this item?")
                    ),
                    "visible" => Yii::app()->user->checkAccess("D2company.CcmpCompany.Delete")
                ));
                break;
        }
        ?>    </div>
</div>

<?php if ($this->action->id == 'admin'): ?><div class="search-form" style="display:none">
        <?php $this->renderPartial('_search', array('model' => $model,)); ?>
    </div>
<?php endif; ?>