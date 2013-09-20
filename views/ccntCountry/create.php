

<?php
$this->breadcrumbs[Yii::t('crud','Ccnt Countries')] = array('admin');
$this->breadcrumbs[] = Yii::t('crud', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('crud','Ccnt Country')?>
        <small><?php echo Yii::t('crud','Create')?></small>
            </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));?>