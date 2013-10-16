<?php
$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Ccuc User Company')
        . ' - '
        . Yii::t('d2companyModule.crud_static', 'Update')
        . ': '   
        . $model->getItemLabel()
);    
$this->breadcrumbs[Yii::t('d2companyModule.crud','Ccuc User Companies')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('d2companyModule.crud_static', 'Update');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('d2companyModule.crud','Ccuc User Company'); ?>
        <small>
            <?php echo Yii::t('d2companyModule.crud_static','Update')?> #<?php echo $model->ccuc_id ?>
        </small>
        
    </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<?php
    $this->renderPartial('_form', array('model' => $model));
?>
