<?php
$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Ccmp Company')
        . ' - '
        . Yii::t('d2companyModule.p3crud', 'Create')
);
?>
<h1>
    <?php echo Yii::t('crud','Ccmp Company')?>
    <small><?php echo Yii::t('d2companyModule.p3crud','Create')?></small>
</h1>

<?php 
$this->renderPartial("_toolbar", array("model"=>$model));
$this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));