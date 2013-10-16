<div class="crud-form">


    <?php
    Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
    Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
    Yii::app()->clientScript->registerScript('crud/variant/update', '$(".crud-form select").select2();');

    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'ccuc-user-company-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));

    echo $form->errorSummary($model);
    ?>

    <div class="row">
        <div class="span9"> <!-- main inputs -->
            <div class="form-horizontal">


                <div class="control-group">
                    <div class='control-label'>
                        <?php ?>
                    </div>
                    <div class='controls'>
                        <?php
                        ;
                        echo $form->error($model, 'ccmp_id')
                        ?>
                        <span class="help-block">

                            <?php
                            echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_id') != 'CcmpCompany.ccmp_id') ? $t : ''
                            ?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'username') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20));
                        echo $form->error($model, 'username')
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'password') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo $form->textField($model, 'password', array('size' => 60, 'maxlength' => 128));
                        echo $form->error($model, 'password')
                        ?>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'email') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128));
                        echo $form->error($model, 'email')
                        ?>
                    </div>
                </div>

                <?php
                $profileFields = Profile::getFields();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        // tikai vards un uzvards
                        if($field->varname != 'first_name' && $field->varname != 'last_name'){
                            continue;
                        }
                        ?>
                        <div class="control-group">
                            <div class='control-label'>
                                <?php echo $form->labelEx($profile, $field->varname); ?>
                            </div>
                            <div class='controls'>
                            <?php
                            if ($widgetEdit = $field->widgetEdit($profile)) {
                                echo $widgetEdit;
                            } elseif ($field->range) {
                                echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                            } elseif ($field->field_type == "TEXT") {
                                echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                            } else {
                                echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                            }
                            ?>
                            <?php echo $form->error($profile, $field->varname); ?>
                            </div>
                        </div>
                        <?php
                    }
                }


                // only for new customers
                if (!isset($model->ccmp_id)) {
                    ?>

                    <div class="control-group">
                        <div class='control-label'>
    <?php echo CHtml::label(Yii::t('d2companyModule.crud', 'Username'), FALSE); ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo CHtml::textField('username', '', array('size' => 100, 'maxlength' => 100));
                            ?>
                            <span class="hint">
                                If entered, customer user will be created automaticaly
                            </span>


                        </div>
                    </div>
                <? } ?>

                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'ccmp_ccnt_id') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        $this->widget(
                                '\GtcRelation', array(
                            'model' => $model,
                            'relation' => 'ccmpCcnt',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all', 'style' => 'width: 200px;'),
                                )
                        );
                        echo $form->error($model, 'ccmp_ccnt_id')
                        ?>
                        <span class="help-block">

                            <?php
                            echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_ccnt_id') != 'CcmpCompany.ccmp_ccnt_id') ? $t : ''
                            ?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'ccmp_office_ccit_id') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        $this->widget(
                                '\GtcRelation', array(
                            'model' => $model,
                            'relation' => 'ccmpOfficeCcit',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all', 'style' => 'width: 200px;'),
                                )
                        );
                        echo $form->error($model, 'ccmp_office_ccit_id')
                        ?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_ccit_id') != 'CcmpCompany.ccmp_office_ccit_id') ? $t : ''
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_registrtion_no') ?>
                    </div>
                    <div class='controls'>
<?php
echo $form->textField($model, 'ccmp_registrtion_no', array('size' => 20, 'maxlength' => 20));
echo $form->error($model, 'ccmp_registrtion_no')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_registrtion_no') != 'CcmpCompany.ccmp_registrtion_no') ? $t : ''
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_vat_registrtion_no') ?>
                    </div>
                    <div class='controls'>
<?php
echo $form->textField($model, 'ccmp_vat_registrtion_no', array('size' => 20, 'maxlength' => 20));
echo $form->error($model, 'ccmp_vat_registrtion_no')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_vat_registrtion_no') != 'CcmpCompany.ccmp_vat_registrtion_no') ? $t : ''
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_office_address') ?>
                    </div>
                    <div class='controls'>
<?php
echo $form->textField($model, 'ccmp_office_address', array('size' => 60, 'maxlength' => 200));
echo $form->error($model, 'ccmp_office_address')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_address') != 'CcmpCompany.ccmp_office_address') ? $t : '';
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_official_address') ?>
                    </div>
                    <div class='controls'>
<?php
echo $form->textField($model, 'ccmp_official_address', array('size' => 60, 'maxlength' => 200));
echo $form->error($model, 'ccmp_official_address')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_official_address') != 'CcmpCompany.ccmp_official_address') ? $t : ''
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_statuss') ?>
                    </div>
                    <div class='controls'>
<?php
echo CHtml::activeDropDownList($model, 'ccmp_statuss', array(
    'ACTIVE' => 'ACTIVE',
    'CLOSED' => 'CLOSED',
    'POTENTIAL' => 'POTENTIAL',
));
echo $form->error($model, 'ccmp_statuss')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_statuss') != 'CcmpCompany.ccmp_statuss') ? $t : ''
?>
                        </span>
                    </div>
                </div>


                <div class="control-group">
                    <div class='control-label'>
<?php echo $form->labelEx($model, 'ccmp_description') ?>
                    </div>
                    <div class='controls'>
<?php
echo $form->textArea($model, 'ccmp_description', array('rows' => 6, 'cols' => 50));
echo $form->error($model, 'ccmp_description')
?>
                        <span class="help-block">

<?php
echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_description') != 'CcmpCompany.ccmp_description') ? $t : ''
?>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <!-- sub inputs -->
    </div>

    <p class="alert">


<?php echo Yii::t('d2companyModule.crud_static', 'Fields with <span class="required">*</span> are required.'); ?>

    </p>

    <div class="form-actions">

<?php
echo CHtml::Button(
        Yii::t('d2companyModule.crud_static', 'Cancel'), array(
    'submit' => (isset($_GET['returnUrl'])) ? $_GET['returnUrl'] : array('ccmpCompany/admin'),
    'class' => 'btn'
));
echo ' ' . CHtml::submitButton(Yii::t('d2companyModule.crud_static', 'Save'), array(
    'class' => 'btn btn-primary'
));
?>
    </div>

<?php $this->endWidget() ?>
</div> <!-- form -->