<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'ccbr_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccbr_ccmp_id'); ?>
            <?php echo $form->textField($model,'ccbr_ccmp_id',array('size'=>10,'maxlength'=>10)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccbr_name'); ?>
            <?php echo $form->textField($model,'ccbr_name',array('size'=>60,'maxlength'=>350)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccrb_code'); ?>
            <?php echo $form->textField($model,'ccrb_code',array('size'=>50,'maxlength'=>50)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccbr_notes'); ?>
            <?php echo $form->textArea($model,'ccbr_notes',array('rows'=>6, 'cols'=>50)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccbr_hide'); ?>
            <?php echo $form->textField($model,'ccbr_hide'); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.p3crud','Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
