<?php
/* @var $this CccfCustomFieldController */
/* @var $model BaseCccfCustomField */

$this->breadcrumbs=array(
	'Base Cccf Custom Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BaseCccfCustomField', 'url'=>array('index')),
	array('label'=>'Create BaseCccfCustomField', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#base-cccf-custom-field-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Base Cccf Custom Fields</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'base-cccf-custom-field-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		/*
		'required',
		'match',
		'range',
		'error_message',
		'other_validator',
		'default',
		'widget',
		'widgetparams',
		'position',
		'visible',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
