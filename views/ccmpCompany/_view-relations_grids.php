<?php
if(!$ajax){
    Yii::app()->clientScript->registerCss('rel_grid',' 
            .rel-grid-view {margin-top:-60px;}
            .rel-grid-view div.summary {height: 60px;}
            ');     
}
?>
<?php
if((!$ajax || $ajax == 'ccbr-branch-grid') 
        && Yii::app()->user->checkAccess("D2company.CcbrBranch.View")
        && !empty($modelMain->ccbrBranches)){
    Yii::beginProfile('ccbr_ccmp_id.view.grid');
        
    $grid_error = '';
    $grid_warning = '';
    
    if (empty($modelMain->ccbrBranches)) {
        $model = new CcbrBranch;
        $model->ccbr_ccmp_id = $modelMain->primaryKey;
        if(!$model->save()){
            $grid_error .= implode('<br/>',$model->errors);
        }
        unset($model);
    }     
?>

<div class="table-header">
    <?=Yii::t('D2companyModule.crud', 'Ccbr Branch')?>
    <?php    
    if(Yii::app()->user->checkAccess("D2company.CcbrBranch.Create")){    
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'ajaxButton', 
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'icon' => 'icon-plus',
                'url' => array(
                    '//d2company/ccbrBranch/ajaxCreate',
                    'field' => 'ccbr_ccmp_id',
                    'value' => $modelMain->primaryKey,
                    'ajax' => 'ccbr-branch-grid',
                ),
                'ajaxOptions' => array(
                        'success' => 'function(html) {$.fn.yiiGridView.update(\'ccbr-branch-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2companyModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),                 
            )
        );        
    }
    ?>
</div>
 
<?php 

    if(!empty($grid_error)){
        ?>
        <div class="alert alert-error"><?php echo $grid_error?></div>
        <?php
    }  

    if(!empty($grid_warning)){
        ?>
        <div class="alert alert-warning"><?php echo $grid_warning?></div>
        <?php
    }  

    $model = new CcbrBranch();
    $model->ccbr_ccmp_id = $modelMain->primaryKey;

    // render grid view
    $can_edit = Yii::app()->user->checkAccess("D2company.CcbrBranch.Update");
    $this->widget('TbGridView',
        array(
            'id' => 'ccbr-branch-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                //varchar(350)
                'class' => 'editable.EditableColumn',
                'name' => 'ccbr_name',
                'editable' => array(
                    'url' => $this->createUrl('//d2company/ccbrBranch/editableSaver'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(50)
                'class' => 'editable.EditableColumn',
                'name' => 'ccbr_code',
                'editable' => array(
                    'url' => $this->createUrl('//d2company/ccbrBranch/editableSaver'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccbr_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2company/ccbrBranch/editableSaver'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccbr_hide',
                'editable' => array(
                    'url' => $this->createUrl('//d2company/ccbrBranch/editableSaver'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                ),
                'htmlOptions' => array(
                    'class' => 'numeric-column',
                ),
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2company/ccbrBranch/delete", array("ccbr_id" => $data->ccbr_id))',
                    'deleteConfirmation'=>Yii::t('D2companyModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),        
                    'visible' => Yii::app()->user->checkAccess("D2company.CcbrBranch.Delete"),  
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('ccbr_ccmp_id.view.grid');
}    
?>

<?php
if((!$ajax || $ajax == 'ccuc-user-company-grid')
        && Yii::app()->user->checkAccess("D2company.CcucUserCompany.View")
){
    Yii::beginProfile('ccuc_ccmp_id.view.grid');
        
    $grid_error = '';
    $grid_warning = '';
    
    if (empty($modelMain->ccucUserCompany)) {
        $model = new CcucUserCompany;
        $model->ccuc_ccmp_id = $modelMain->primaryKey;
        if(!$model->save()){
            $grid_error .= implode('<br/>',$model->errors);
        }
        unset($model);
    }     
?>

<div class="table-header">
    <?=Yii::t('D2companyModule.crud', 'Ccuc User Company')?>
    <?php    
    // "+" poga noņemta, jo nevar pievienot tukšu ierakstu
    if(Yii::app()->user->checkAccess("D2company.CcucUserCompany.Create")){            
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'ajaxButton', 
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'icon' => 'icon-plus',
                'url' => array(
                    '//d2company/ccucUserCompany/ajaxCreate',
                    'field' => 'ccuc_ccmp_id',
                    'value' => $modelMain->primaryKey,
                    'ajax' => 'ccuc-user-company-grid',
                ),
                'ajaxOptions' => array(
                        'success' => 'function(html) {$.fn.yiiGridView.update(\'ccuc-user-company-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2companyModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),                 
            )
        );        
    }    
    ?>
</div>
 
<?php 

    if(!empty($grid_error)){
        ?>
        <div class="alert alert-error"><?php echo $grid_error?></div>
        <?php
    }  

    if(!empty($grid_warning)){
        ?>
        <div class="alert alert-warning"><?php echo $grid_warning?></div>
        <?php
    }  

    $model = new CcucUserCompany();
    $model->ccuc_ccmp_id = $modelMain->primaryKey;

    // render grid view
    $can_edit = Yii::app()->user->checkAccess("D2company.CcucUserCompany.Update");
    $this->widget('TbGridView',
        array(
            'id' => 'ccuc-user-company-grid',
            'dataProvider' => $model->searchPersonsForRel(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_person_id',
                'value' => '$data->pprs_second_name . " " . $data->pprs_first_name',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2company/ccucUserCompany/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->findAll(array('limit' => 1000)), 'pprs_id', 'itemLabel'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                )
            ),
//            array(
//                    'class' => 'editable.EditableColumn',
//                    'name' => 'ccuc_status',
//                    'editable' => array(
//                        'type' => 'select',
//                        'url' => $this->createUrl('//d2company/ccucUserCompany/editableSaver'),
//                        'source' => $model->getEnumFieldLabels('ccuc_status'),
//                        'apply' => $can_edit,
//                        //'placement' => 'right',
//                    ),
//                   'filter' => $model->getEnumFieldLabels('ccuc_status'),
//                ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_cucp_id',
                'value' => '$data->cucp_name',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2company/ccucUserCompany/editableSaver'),
                    'source' => CHtml::listData(CucpUserCompanyPosition::model()->findAll(array('limit' => 1000)), 'cucp_id', 'itemLabel'),
                    'apply' => $can_edit,
                    //'placement' => 'right',
                )
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2company/ccucUserCompany/delete", array("ccuc_id" => $data->ccuc_id))',
                    'deleteConfirmation'=>Yii::t('D2companyModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),        
                    'visible' => Yii::app()->user->checkAccess("D2company.CcucUserCompany.Delete"),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('ccuc_ccmp_id.view.grid');
}    
?>

<?php
if((!$ajax || $ajax == 'ccxg-company-xgroup-grid')
        && Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.View")
){
    Yii::beginProfile('ccxg_ccmp_id.view.grid');
        
    $grid_error = '';
    $grid_warning = '';
    
    if (empty($modelMain->ccxgCompanyXGroups)) {
        $model = new CcxgCompanyXGroup;
        $model->ccxg_ccmp_id = $modelMain->primaryKey;
        if(!$model->save()){
            $grid_error .= implode('<br/>',$model->errors);
        }
        unset($model);
    }     
?>

<div class="table-header">
    <?=Yii::t('D2companyModule.crud', 'Ccxg Company Xgroup')?>
    <?php    
    if(Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.Update")){        
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'ajaxButton', 
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'icon' => 'icon-plus',
                'url' => array(
                    '//d2company/ccxgCompanyXGroup/ajaxCreate',
                    'field' => 'ccxg_ccmp_id',
                    'value' => $modelMain->primaryKey,
                    'ajax' => 'ccxg-company-xgroup-grid',
                ),
                'ajaxOptions' => array(
                        'success' => 'function(html) {$.fn.yiiGridView.update(\'ccxg-company-xgroup-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2companyModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),                 
            )
        );        
    }    
    ?>
</div>
 
<?php 

    if(!empty($grid_error)){
        ?>
        <div class="alert alert-error"><?php echo $grid_error?></div>
        <?php
    }  

    if(!empty($grid_warning)){
        ?>
        <div class="alert alert-warning"><?php echo $grid_warning?></div>
        <?php
    }  

    $model = new CcxgCompanyXGroup();
    $model->ccxg_ccmp_id = $modelMain->primaryKey;

    // render grid view
    $can_edit = Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.Update");
    $this->widget('TbGridView',
        array(
            'id' => 'ccxg-company-xgroup-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccxg_ccgr_id',
                'value' => '!empty($data->ccxg_ccgr_id)?$data->ccxgCcgr->itemLabel:" - "',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2company/ccxgCompanyXGroup/editableSaver'),
                    'source' => CHtml::listData(CcgrGroup::model()->findAll(array('limit' => 1000)), 'ccgr_id', 'itemLabel'),
                    'apply' => $can_edit?'TRUE && $data->ccxg_ccgr_id != '.Yii::app()->params['ccgr_group_sys_company']:'FALSE',
                    //'placement' => 'right',
                )
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => "TRUE"),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2company/ccxgCompanyXGroup/delete", array("ccxg_id" => $data->ccxg_id))',
                    'deleteConfirmation'=>Yii::t('D2companyModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                    'visible' => Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.Delete"),
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('ccxg_ccmp_id.view.grid');
}    

if((!$ajax || $ajax == 'ccdp-department-grid')
        && Yii::app()->user->checkAccess("D2company.CcdpDepartment.View")){
    $can_create = Yii::app()->user->checkAccess("D2company.CcdpDepartment.Create");
    
    Yii::beginProfile('ccdp_ccmp_id.view.grid');
        
    $grid_error = '';
    $grid_warning = '';

    $model = false;
    if (empty($modelMain->ccdpDepartments) && $can_create) {
        $model = new CcdpDepartment;
        $model->ccdp_ccmp_id = $modelMain->primaryKey;
        if(!$model->save()){
            $grid_error .= implode('<br/>',$model->errors);
        }
    }     
?>

<div class="table-header">
    <?=Yii::t('D2companyModule.crud', 'Ccdp Department')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2company/ccdpDepartment/ajaxCreate',
                'field' => 'ccdp_ccmp_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ccdp-department-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ccdp-department-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2companyModule.crud', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
            'visible' => $can_create,
        )
    );        
    ?>
</div>
 
<?php 

    if(!empty($grid_error)){
        ?>
        <div class="alert alert-error"><?php echo $grid_error?></div>
        <?php
    }  

    if(!empty($grid_warning)){
        ?>
        <div class="alert alert-warning"><?php echo $grid_warning?></div>
        <?php
    }  

    if (!empty($modelMain->ccdpDepartments) || $model !== false) {
        $model = new CcdpDepartment();
        $model->ccdp_ccmp_id = $modelMain->primaryKey;

        // render grid view

        $this->widget('TbGridView',
            array(
                'id' => 'ccdp-department-grid',
                'dataProvider' => $model->search(),
                'template' => '{summary}{items}',
                'summaryText' => '&nbsp;',
                'htmlOptions' => array(
                    'class' => 'rel-grid-view'
                ),            
                'columns' => array(
                    array(
                    //varchar(50)
                    'class' => 'editable.EditableColumn',
                    'name' => 'ccdp_name',
                    'editable' => array(
                        'url' => $this->createUrl('//d2company/ccdpDepartment/editableSaver'),
                        'apply' => Yii::app()->user->checkAccess("D2company.CcdpDepartment.Update")
                    )
                ),

                    array(
                        'class' => 'TbButtonColumn',
                        'buttons' => array(
                            'view' => array('visible' => 'FALSE'),
                            'update' => array('visible' => 'FALSE'),
                            'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcdpDepartment.Delete")'),
                        ),
                        'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2company/ccdpDepartment/delete", array("ccdp_id" => $data->ccdp_id))',
                        'deleteConfirmation'=>Yii::t('D2companyModule.crud','Do you want to delete this item?'),   
                        'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                    ),
                )
            )
        );
    }
    ?>

<?php
    Yii::endProfile('ccdp_ccmp_id.view.grid');
}     

$this->widget('d2FilesWidget',array('module'=>$this->module->id, 'model'=>$modelMain));
