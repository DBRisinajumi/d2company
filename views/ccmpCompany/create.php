<?php
$this->setPageTitle(
        Yii::t('D2companyModule.crud', 'Companies')
        . ' - '
        . Yii::t('D2companyModule.crud_static', 'Create')
);
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2companyModule.crud_static","Back"),
                )
 ),true);
    
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-building"></i>
                <?php echo Yii::t('D2companyModule.crud_static','Create');?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
               if(Yii::app()->user->checkAccess("audittrail") 
                    && isset(Yii::app()->getModule('d2company')->options['audittrail']) 
                    && Yii::app()->getModule('d2company')->options['audittrail'])
                {        
                    Yii::import('audittrail.*');
                    $this->widget('EFancyboxWidget',array(
                        'selector'=>'a[href*=\'audittrail/show/fancybox\']',
                        'options'=>array(
                        ),
                    ));        
                    $this->widget("vendor.dbrisinajumi.audittrail.widgets.AudittrailViewTbButton",array(
                        'model_name' => get_class($model),
                        'model_id' => $model->getPrimaryKey(),
                    ));                       
                }                
            ?>
        </div>
    </div>
</div>

<?php

$this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));