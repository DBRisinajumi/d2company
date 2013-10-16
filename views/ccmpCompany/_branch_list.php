<?php
$this->widget("bootstrap.widgets.TbButton", array(
    "label" => Yii::t("d2companyModule.crud_static", "Create"),
    "icon" => "icon-plus",
    "url" => array("createccbr",'ccmp_id'=>$ccmp_id),
));
?>                

<?php

$this->widget('TbGridView', array(
    'id' => 'ccbr-branch-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'template' => '{pager}{summary}{items}{pager}',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccbr_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccrb_code',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccbr_hide',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
            //'placement' => 'right',
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'FALSE'),
                'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcbrBranch.Update")'),
                'delete' => array('visible' => 'FALSE'),
            ),
            //'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccbr_id" => $data->ccbr_id))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateccbr", array("ccbr_id" => $data->ccbr_id,"ccmp_id" => $data->ccbr_ccmp_id))',
        //'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccbr_id" => $data->ccbr_id))',
        ),
    )
        )
);
?>
