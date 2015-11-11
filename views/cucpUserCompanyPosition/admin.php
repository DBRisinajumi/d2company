<?php
$this->setPageTitle(Yii::t('D2companyModule.model', 'Person Positions'));
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2companyModule.crud','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
             'visible'=>(Yii::app()->user->checkAccess('D2company.CucpUserCompanyPosition.*') || Yii::app()->user->checkAccess('D2company.CucpUserCompanyPosition.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2companyModule.model', 'Person Positions');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('CucpUserCompanyPosition.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'cucp-user-company-position-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                //varchar(100)
                'class' => 'editable.EditableColumn',
                'name' => 'cucp_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/cucpUserCompanyPosition/editableSaver'),
                    'placement' => 'right',
                )
            ),
            array(
                //char(20)
                'class' => 'editable.EditableColumn',
                'name' => 'cucp_role',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/cucpUserCompanyPosition/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CucpUserCompanyPosition.Delete")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("cucp_id" => $data->cucp_id))',
                'deleteConfirmation'=>Yii::t('D2companyModule.crud','Do you want to delete this item?'),                    
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('CucpUserCompanyPosition.view.grid'); ?>