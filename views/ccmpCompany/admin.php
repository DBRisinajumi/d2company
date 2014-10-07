<?php
$this->setPageTitle(Yii::t('D2companyModule.crud', 'Companies List'));

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccmp-company-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");

Yii::app()->clientScript->registerScript('export', "
    $('.export-button').click(function(){
        $('.export-form').toggle();
        return false;
    });  
    ");
?>

<table class="toolbar">
    <tr>  
        <td>  
            <h2>
                <?php echo Yii::t('D2companyModule.crud', 'Companies'); ?>
                <small><?php echo Yii::t('D2companyModule.crud_static', 'List'); ?></small>
            </h2>    
        </td>  
        <td>
            <?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
        </td>
    </tr> 
</table>    

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array('model' => $model,)); ?>
</div>
<div class="export-form" style="display:none">
    <?php $this->renderPartial('_export', array('model' => $model,)); ?>
</div>


<?php
$visible_columns = false;
if (isset(Yii::app()->getModule('d2company')->options['admin_columns'])) {
    $visible_columns = Yii::app()->getModule('d2company')->options['admin_columns'];
}

$grid_columns = array(
    array(
        'name' => 'ccmp_name',
        'header' => Yii::t('D2companyModule.crud', 'Name'),
        'visible' => !$visible_columns || in_array('ccmp_name', $visible_columns),
    ),
    array(
        'name' => 'ccmp_ccnt_id',
        'header' => Yii::t('D2companyModule.crud', 'Country'),
        'value' => 'CHtml::value($data,\'ccmpCcnt.itemLabel\')',
        'filter' => CHtml::listData(CcntCountry::model()->findAll(array('limit' => 1000)), 'ccnt_id', 'itemLabel'),
        'htmlOptions' => array('style' => 'width:100px;'),
        'visible' => !$visible_columns || in_array('ccmp_ccnt_id', $visible_columns),
    ),
    array(
        'name' => 'ccmp_office_ccit_id',
        'header' => Yii::t('D2companyModule.crud', 'City'),
        'value' => 'CHtml::value($data,\'ccmpOfficeCcit.itemLabel\')',
        'filter' => CHtml::listData(CcitCity::model()->findAll(array('limit' => 1000)), 'ccit_id', 'itemLabel'),
        'visible' => !$visible_columns || in_array('ccmp_office_ccit_id', $visible_columns),
    ),
    array(
        'name' => 'ccmp_registrtion_no',
        'header' => Yii::t('D2companyModule.crud', 'Registration Nr'),
        'visible' => !$visible_columns || in_array('ccmp_registrtion_no', $visible_columns),
    ),
    array(
        'name' => 'ccmp_registration_address',
        'header' => Yii::t('D2companyModule.crud', 'Registration Address'),
        'visible' => !$visible_columns || in_array('ccmp_registration_address', $visible_columns),
    ),
    array(
        'name' => 'ccmp_statuss',
        'header' => Yii::t('D2companyModule.crud', 'State'),
        'visible' => !$visible_columns || in_array('ccmp_statuss', $visible_columns),
        ));

if (isset(Yii::app()->getModule('d2company')->options['admin_add_columns'])) {
    foreach(Yii::app()->getModule('d2company')->options['admin_add_columns'] as $add_column){
        if(isset($add_column['header'])){
            $add_column['header'] = Yii::t('D2companyModule.crud', $add_column['header']);
        }
        $grid_columns[] = $add_column;
    }
}

$grid_columns[] = array(
    'class' => 'EButtonColumnWithClearFilters',
    'buttons' => array(
        'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcmpCompany.View")
                                           || Yii::app()->user->checkAccess("D2company.CcmpCompany.Update") 
                                           || Yii::app()->user->checkAccess("Company.fullcontrol")'),
        'update' => array('visible' => 'Yii::app()->user->checkAccess("Company.fullcontrol") '
            . '                            || Yii::app()->user->checkAccess("D2company.CcmpCompany.Update")'),
        'delete' => array('visible' => 'FALSE'),
    ),
    'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ccmp_id" => $data->ccmp_id))',
    'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateExtended", array("ccmp_id" => $data->ccmp_id))',
    'deleteButtonUrl' => null,
    'viewButtonOptions' => array('data-toggle' => 'tooltip'),
    'updateButtonOptions' => array('data-toggle' => 'tooltip'),
);


$this->widget('TbGridView', array(
    'id' => 'ccmp-company-grid',
    'type' => 'bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => '{items}{summary}{pager}',
    'rowCssClassExpression' => '$data->cssclass',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => $grid_columns,
        )
);
