<?php 
$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Ccnt Country')
        . ' - '
        . Yii::t('d2companyModule.p3crud', 'Update')
        . ': '
        . $model->getItemLabel()
);

?>
<h1>

    <?php echo Yii::t('d2companyModule.crud','Ccnt Country'); ?>
    <small>
        <?php echo Yii::t('d2companyModule.p3crud','Update')?>: <?php echo $model->ccnt_name ?>
    </small>

</h1>

<?php 
$this->renderPartial("_toolbar", array("model"=>$model)); 
$this->renderPartial('_form', array('model'=>$model));