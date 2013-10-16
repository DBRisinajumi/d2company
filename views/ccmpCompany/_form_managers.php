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
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('d2companyModule.crud_static', 'Data') ?>                <small>
                    <?php echo $model->itemLabel ?>
                </small>

            </h2>


            <div class="form-horizontal">


                <div class="control-group">
                    <div class='control-label'>
                        <?php ?>
                    </div>
                    <div class='controls'>
                        <?php
                        ;
                        echo $form->error($model, 'ccuc_id')
                        ?>
                        <span class="help-block">
                            <?php echo (($t = Yii::t('d2companyModule.crud', 'CcucUserCompany.ccuc_id')) != 'CcucUserCompany.ccuc_id') ? $t : '' ?>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'ccuc_first_name') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo $form->textField($model, 'ccuc_first_name', array('size' => 60, 'maxlength' => 255));
                        echo $form->error($model, 'ccuc_first_name')
                        ?>
                        <span class="help-block">
                            <?php echo (($t = Yii::t('d2companyModule.crud', 'CcucUserCompany.ccuc_first_name')) != 'CcucUserCompany.ccuc_first_name') ? $t : '' ?>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'cucc_last_name') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo $form->textField($model, 'cucc_last_name', array('size' => 60, 'maxlength' => 255));
                        echo $form->error($model, 'cucc_last_name')
                        ?>
                        <span class="help-block">
                            <?php echo (($t = Yii::t('d2companyModule.crud', 'CcucUserCompany.cucc_last_name')) != 'CcucUserCompany.cucc_last_name') ? $t : '' ?>
                        </span>
                    </div>
                </div>
                <?if(FALSE){?>
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
                <?}?>

                <div class="control-group">
                    <div class='control-label'>
                        <?php echo $form->labelEx($model, 'ccuc_status') ?>
                    </div>
                    <div class='controls'>
                        <?php
                        echo CHtml::activeDropDownList($model, 'ccuc_status', array(
                            'ACTIVE' => 'ACTIVE',
                            'DISABLED' => 'DISABLED',
                        ));
                        echo $form->error($model, 'ccuc_status')
                        ?>
                        <span class="help-block">
                            <?php echo (($t = Yii::t('d2companyModule.crud', 'CcucUserCompany.ccuc_status')) != 'CcucUserCompany.ccuc_status') ? $t : '' ?>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <p class="alert">
        <?php echo Yii::t('d2companyModule.crud_static', 'Fields with <span class="required">*</span> are required.'); ?>
    </p>

    <div class="form-actions">

        <?php
        echo CHtml::Button(
                Yii::t('d2companyModule.crud_static', 'Cancel'), array(
            'submit' => (isset($_GET['returnUrl'])) ? $_GET['returnUrl'] : array('ccucUserCompany/admin'),
            'class' => 'btn'
        ));
        echo ' ' . CHtml::submitButton(Yii::t('d2companyModule.crud_static', 'Save'), array(
            'class' => 'btn btn-primary'
        ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> 