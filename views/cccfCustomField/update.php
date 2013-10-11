<?php
/* @var $this CccfCustomFieldController */
/* @var $model BaseCccfCustomField */

$this->breadcrumbs=array(
	'Base Cccf Custom Fields'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseCccfCustomField', 'url'=>array('index')),
	array('label'=>'Create BaseCccfCustomField', 'url'=>array('create')),
	array('label'=>'View BaseCccfCustomField', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BaseCccfCustomField', 'url'=>array('admin')),
);
?>

<h1>Update BaseCccfCustomField <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>