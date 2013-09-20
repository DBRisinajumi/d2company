<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'ccmp_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_name'); ?>
            <?php echo $form->textField($model,'ccmp_name',array('size'=>60,'maxlength'=>200)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_ccnt_id'); ?>
            <?php echo $form->textField($model,'ccmp_ccnt_id'); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_registrtion_no'); ?>
            <?php echo $form->textField($model,'ccmp_registrtion_no',array('size'=>20,'maxlength'=>20)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_vat_registrtion_no'); ?>
            <?php echo $form->textField($model,'ccmp_vat_registrtion_no',array('size'=>20,'maxlength'=>20)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_registration_address'); ?>
            <?php echo $form->textField($model,'ccmp_registration_address',array('size'=>60,'maxlength'=>200)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_official_address'); ?>
            <?php echo $form->textField($model,'ccmp_official_address',array('size'=>60,'maxlength'=>200)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_statuss'); ?>
            <?php echo CHtml::activeDropDownList($model, 'ccmp_statuss', array(
            'ACTIVE' => 'ACTIVE' ,
            'CLOSED' => 'CLOSED' ,
)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccmp_description'); ?>
            <?php echo $form->textArea($model,'ccmp_description',array('rows'=>6, 'cols'=>50)); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
