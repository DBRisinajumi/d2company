<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'ccgr_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccgr_name'); ?>
            <?php echo $form->textField($model,'ccgr_name',array('size'=>20,'maxlength'=>20)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccgr_notes'); ?>
            <?php echo $form->textArea($model,'ccgr_notes',array('rows'=>6, 'cols'=>50)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccgr_hide'); ?>
            <?php echo $form->textField($model,'ccgr_hide'); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
