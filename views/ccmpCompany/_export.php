<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl('d2company/ccmpCompany/export'),
        'method'=>'post',
    )); ?>

    
         

    
        <div class="row">
            <?php echo CHtml::label(Yii::t('d2companyModule.crud', 'File name'),FALSE); ?>
            <?php echo CHtml::textField('file_name','report' ,array('size'=>100,'maxlength'=>200)); ?>
            <?php echo CHtml::label(Yii::t('d2companyModule.crud', 'Author'),FALSE); ?>
            <?php echo CHtml::textField('author',Yii::app()->user->first_name ,array('size'=>100,'maxlength'=>200)); ?>
         
        </div>

    <div class="form-actions">
       
                 <?php echo CHtml::submitButton('Excel',array('class'=>'excel_button')); ?>
                 <?php echo CHtml::submitButton(Yii::t('d2companyModule.crud_static','PDF'),array('class'=>'excel_button')); ?>
    </div>    
   

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
