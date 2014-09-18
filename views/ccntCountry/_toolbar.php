
<div class="btn-toolbar">
    <div class="btn-group">
        <?php
                   switch($this->action->id) {
                       case "create":
                           $this->widget("bootstrap.widgets.TbButton", array(
                               "label"=>Yii::t("D2companyModule.crud_static","Manage"),
                        "icon"=>"icon-list-alt",
                        "url"=>array("admin"),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    break;
                case "admin":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Create"),
                        "icon"=>"icon-plus",
                        "url"=>array("create"),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    break;
                case "view":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Manage"),
                        "icon"=>"icon-list-alt",
                        "url"=>array("admin"),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Update"),
                        "icon"=>"icon-edit",
                        "url"=>array("update","ccnt_id"=>$model->{$model->tableSchema->primaryKey}),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Create"),
                        "icon"=>"icon-plus",
                        "url"=>array("create"),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Delete"),
                        "type"=>"danger",
                        "icon"=>"icon-remove icon-white",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","ccnt_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                            "confirm"=>Yii::t('D2companyModule.crud_static','Do you want to delete this item?')
                        ),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    break;
                case "update":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Manage"),
                        "icon"=>"icon-list-alt",
                        "url"=>array("admin"),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
//                    $this->widget("bootstrap.widgets.TbButton", array(
//                        "label"=>Yii::t("D2companyModule.crud_static","View"),
//                        "icon"=>"icon-eye-open",
//                        "url"=>array("view","ccnt_id"=>$model->{$model->tableSchema->primaryKey}),
//                        "visible"=>Yii::app()->user->checkAccess("D2company.CcntCountry.View")
//                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud_static","Delete"),
                        "type"=>"danger",
                        "icon"=>"icon-remove icon-white",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","ccnt_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                            "confirm"=>Yii::t('D2companyModule.crud_static','Do you want to delete this item?')
                        ),
                        "visible"=>Yii::app()->user->checkAccess("Company.fullcontrol") || Yii::app()->user->checkAccess("DataCardEditor")
                    ));
                    break;
            }
        ?>    </div>
</div>

<?php if($this->action->id == 'admin'): ?><div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</div>
<?php endif; ?>