<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'ccnt_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccnt_name'); ?>
            <?php echo $form->textField($model,'ccnt_name',array('size'=>60,'maxlength'=>200)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccnt_code'); ?>
            <?php echo $form->textField($model,'ccnt_code',array('size'=>3,'maxlength'=>3)); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.p3crud','Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
