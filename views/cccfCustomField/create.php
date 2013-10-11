<?php
/* @var $this CccfCustomFieldController */
/* @var $model BaseCccfCustomField */

$this->breadcrumbs=array(
	'Base Cccf Custom Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseCccfCustomField', 'url'=>array('index')),
	array('label'=>'Manage BaseCccfCustomField', 'url'=>array('admin')),
);
?>

<h1>Create BaseCccfCustomField</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>