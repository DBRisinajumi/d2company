<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
       

    
        <div class="row">
            <?php echo $form->label($model,Yii::t('d2companyModule.crud', 'Name')); ?>
            <?php echo $form->textField($model,'ccmp_name',array('size'=>60,'maxlength'=>200)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,Yii::t('d2companyModule.crud', 'Country')); ?>
            <?php echo $form->textField($model,'ccmp_ccnt_id'); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,Yii::t('d2companyModule.crud', 'Registration Nr')); ?>
            <?php echo $form->textField($model,'ccmp_registrtion_no',array('size'=>20,'maxlength'=>20)); ?>

        </div>

    
       
       
    
        <div class="row">
            <?php echo $form->label($model,Yii::t('d2companyModule.crud', 'State')); ?>
            <?php echo CHtml::activeDropDownList($model, 'ccmp_statuss', array(
            'ACTIVE' => 'ACTIVE' ,
            'CLOSED' => 'CLOSED' ,
)); ?>

        </div>

    
      
    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.p3crud','Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
