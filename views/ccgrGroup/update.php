<?php
$this->breadcrumbs[Yii::t('d2companyModule.crud','Ccgr Groups')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('d2companyModule.crud', 'Update');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('d2companyModule.crud','Ccgr Group'); ?>
        <small>
            <?php echo Yii::t('d2companyModule.crud','Update')?> #<?php echo $model->ccgr_id ?>
        </small>
        
    </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>
