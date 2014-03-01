<?php

$this->widget("bootstrap.widgets.TbButton", array(
    "label" => Yii::t("d2companyModule.crud_static", "Create"),
    "icon" => "icon-plus",
    "url" => array("createManager", 'ccmp_id' => $ccmp_id),
));

$this->widget('TbGridView', array(
    'id' => 'ccuc-user-company-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'template' => '{pager}{items}',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array(
            'class' => 'TbEditableColumn',
            'name' => 'ccuc_first_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                'emptytext' => Yii::t('d2companyModule.crud_static', 'Empty'),
            )
        ),
        array(
            'class' => 'TbEditableColumn',
            'name' => 'cucc_last_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                'emptytext' => Yii::t('d2companyModule.crud_static', 'Empty'),
            )
        ),
        array(
//                            'class' => 'TbEditableColumn',
            'name' => 'ccuc_status',
//                            'editable' => array(
//                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
//                                //'placement' => 'right',
//                            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'FALSE'),
                'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcucUserCompany.Update")'),
                'delete' => array('visible' => 'FALSE'),
            ),
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateManagers", array(
                                                        "ccuc_id" => $data->ccuc_id,
                                                        "ccmp_id" => $data->ccuc_ccmp_id,
                                                        ))',
        ),
    )
        )
);