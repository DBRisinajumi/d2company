

<h1>
        
    <?php echo Yii::t('d2companyModule.crud','Ccnt Country')?>
    <small><?php echo Yii::t('d2companyModule.p3crud','Create')?></small>
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create'));?>