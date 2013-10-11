<?php
/* @var $this CccfCustomFieldController */
/* @var $model BaseCccfCustomField */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'base-cccf-custom-field-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'varname'); ?>
		<?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'varname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_type'); ?>
		<?php echo $form->textField($model,'field_type',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'field_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_size'); ?>
		<?php echo $form->textField($model,'field_size'); ?>
		<?php echo $form->error($model,'field_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_size_min'); ?>
		<?php echo $form->textField($model,'field_size_min'); ?>
		<?php echo $form->error($model,'field_size_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'required'); ?>
		<?php echo $form->textField($model,'required'); ?>
		<?php echo $form->error($model,'required'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'match'); ?>
		<?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'match'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'range'); ?>
		<?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'range'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'error_message'); ?>
		<?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'error_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_validator'); ?>
		<?php echo $form->textArea($model,'other_validator',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'other_validator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'default'); ?>
		<?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'default'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'widget'); ?>
		<?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'widget'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'widgetparams'); ?>
		<?php echo $form->textArea($model,'widgetparams',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'widgetparams'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->textField($model,'visible'); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->