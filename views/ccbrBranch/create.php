

<?php
$this->breadcrumbs[Yii::t('crud','Ccbr Branches')] = array('admin');
$this->breadcrumbs[] = Yii::t('D2companyModule.crud_static','Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('crud','Ccbr Branch')?>
        <small><?php echo Yii::t('D2companyModule.crud_static','Create')?></small>
            </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));?>