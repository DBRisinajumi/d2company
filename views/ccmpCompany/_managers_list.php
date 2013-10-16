<div class="crud-form">

    <?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <div class="form-horizontal">
                <table>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
                <?php
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
                            'class' => 'editable.EditableColumn',
                            'name' => 'ccuc_first_name',
                            'editable' => array(
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                                //'placement' => 'right',
                            )
                        ),
                        array(
                            'class' => 'editable.EditableColumn',
                            'name' => 'cucc_last_name',
                            'editable' => array(
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                                //'placement' => 'right',
                            )
                        ),
                        array(
//                            'class' => 'editable.EditableColumn',
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
                ?>
            </div>
        </div>
    </div>
<?php $form = $this->endWidget(); ?>
</div>
