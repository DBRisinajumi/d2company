<?php
/* @var $this CccfCustomFieldController */
/* @var $model BaseCccfCustomField */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varname'); ?>
		<?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'field_type'); ?>
		<?php echo $form->textField($model,'field_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'field_size'); ?>
		<?php echo $form->textField($model,'field_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'field_size_min'); ?>
		<?php echo $form->textField($model,'field_size_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'required'); ?>
		<?php echo $form->textField($model,'required'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'match'); ?>
		<?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'range'); ?>
		<?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'error_message'); ?>
		<?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_validator'); ?>
		<?php echo $form->textArea($model,'other_validator',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'default'); ?>
		<?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'widget'); ?>
		<?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'widgetparams'); ?>
		<?php echo $form->textArea($model,'widgetparams',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visible'); ?>
		<?php echo $form->textField($model,'visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->