<?php
$this->breadcrumbs[Yii::t('crud','Ccxg Company Xgroups')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2companyModule.crud_static','Update');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('crud','Ccxg Company Xgroup'); ?>
        <small>
            <?php echo Yii::t('D2companyModule.crud_static','Update')?> #<?php echo $model->ccxg_id ?>
        </small>
        
    </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>
