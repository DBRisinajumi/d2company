<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccmp-company-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <div class="form-horizontal">

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <?php
                            ;
                            echo $form->error($model,'ccmp_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_id') != 'CcmpCompany.ccmp_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_name',array('size'=>60,'maxlength'=>200));
                            echo $form->error($model,'ccmp_name')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_name') != 'CcmpCompany.ccmp_name')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_ccnt_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ccmpCcnt',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ccmp_ccnt_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_ccnt_id') != 'CcmpCompany.ccmp_ccnt_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_registrtion_no') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_registrtion_no',array('size'=>20,'maxlength'=>20));
                            echo $form->error($model,'ccmp_registrtion_no')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_registrtion_no') != 'CcmpCompany.ccmp_registrtion_no')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_vat_registrtion_no') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_vat_registrtion_no',array('size'=>20,'maxlength'=>20));
                            echo $form->error($model,'ccmp_vat_registrtion_no')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_vat_registrtion_no') != 'CcmpCompany.ccmp_vat_registrtion_no')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_registration_address') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_registration_address',array('size'=>60,'maxlength'=>200));
                            echo $form->error($model,'ccmp_registration_address')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_registration_address') != 'CcmpCompany.ccmp_registration_address')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_official_address') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_official_address',array('size'=>60,'maxlength'=>200));
                            echo $form->error($model,'ccmp_official_address')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_official_address') != 'CcmpCompany.ccmp_official_address')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_statuss') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo CHtml::activeDropDownList($model, 'ccmp_statuss', array(
            'ACTIVE' => 'ACTIVE' ,
            'CLOSED' => 'CLOSED' ,
));
                            echo $form->error($model,'ccmp_statuss')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_statuss') != 'CcmpCompany.ccmp_statuss')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_description') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model,'ccmp_description',array('rows'=>6, 'cols'=>50));
                            echo $form->error($model,'ccmp_description')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_description') != 'CcmpCompany.ccmp_description')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>
                </div>

        </div>

        <!-- sub inputs -->
    </div>

    <p class="alert">

        
        <?php echo Yii::t('d2companyModule.p3crud','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('d2companyModule.p3crud','Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccmpCompany/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('d2companyModule.p3crud','Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->