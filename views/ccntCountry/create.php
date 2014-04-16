<?php 
$this->setPageTitle(
        Yii::t('D2companyModule.crud', 'Ccnt Country')
        . ' - '
        . Yii::t('D2companyModule.crud_static', 'Create')
);

?>

<h1>
    <?php echo Yii::t('D2companyModule.crud','Ccnt Country')?>
    <small><?php echo Yii::t('D2companyModule.crud_static','Create')?></small>
</h1>

<?php 
$this->renderPartial("_toolbar", array("model"=>$model));
$this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));