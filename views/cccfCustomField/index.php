<?php
/* @var $this CccfCustomFieldController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Cccf Custom Fields',
);

$this->menu=array(
	array('label'=>'Create BaseCccfCustomField', 'url'=>array('create')),
	array('label'=>'Manage BaseCccfCustomField', 'url'=>array('admin')),
);
?>

<h1>Base Cccf Custom Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
