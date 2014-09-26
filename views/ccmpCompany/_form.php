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
        <div class="span9"> <!-- main inputs -->
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
                            <?php echo $form->labelEx($model,'ccmp_office_phone') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_office_phone',array('size'=>60,'maxlength'=>20));
                            echo $form->error($model,'ccmp_office_phone')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_phone') != 'CcmpCompany.ccmp_office_phone')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>
                  <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccmp_office_email') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_office_email',array('size'=>60,'maxlength'=>100));
                            echo $form->error($model,'ccmp_office_email')
                            ?>
                                                      
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_email') != 'CcmpCompany.ccmp_office_email')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>
                
                
                
                <? 
                // only for new customers
                if(FALSE && !isset($model->ccmp_id)){ ?>
                
                 <div class="control-group">
                        <div class='control-label'>
                            <?php echo CHtml::label(Yii::t('D2companyModule.crud', 'Username'),FALSE); ?>
                        </div>
                        <div class='controls'>
                            <?php
                             echo CHtml::textField('username', '' ,array('size'=>100,'maxlength'=>100)); 
                            
                            ?>
                            <span class="hint">
                            If entered, customer user will be created automaticaly
                            </span>
                            
                           
                        </div>
                    </div>
                <? }  ?>
                
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
                            'criteria' => new CDbCriteria(array('order' => 'ccnt_name')),
                            'htmlOptions' => array(
                                'checkAll' => 'all','style' => 'width: 200px;'),
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
                            <?php echo $form->labelEx($model,'ccmp_office_ccit_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ccmpOfficeCcit',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all','style' => 'width: 200px;'),
                            )
                        );
                            echo $form->error($model,'ccmp_office_ccit_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_ccit_id') != 'CcmpCompany.ccmp_office_ccit_id')?$t:''
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
                            <?php echo $form->labelEx($model,'ccmp_registration_date') ?>
                        </div>
                        <div class='controls'>
                            <?php
                                                      /**
                     * @tutorial http://www.yiiframework.com/doc/api/1.1/CJuiWidget
                     * @tutorial http://jqueryui.com/datepicker/
                     */

                            $this->widget('zii.widgets.jui.CJuiDatePicker',
                                            array(
                                                    'model' => $model,
                                                    'attribute' => 'ccmp_registration_date',
                                                    'language' =>  strstr(Yii::app()->language.'_','_',true),
                                                    'htmlOptions' => array('size' => 10),
                                                    'options' => array(
                                                        'showButtonPanel' => true,
                                                        'changeYear' => true,
                                                        'changeYear' => true,
                                                        'dateFormat' => 'yy-mm-dd',
                                                        ),
                                                    )
                                                );
                            echo $form->error($model,'ccmp_registration_date')
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
                            <?php echo $form->labelEx($model,'ccmp_office_address') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccmp_office_address',array('size'=>60,'maxlength'=>200));
                            echo $form->error($model,'ccmp_office_address')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcmpCompany.ccmp_office_address') != 'CcmpCompany.ccmp_office_address')?$t:'';
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
                                   'POTENTIAL' => 'POTENTIAL') ,
                                 array('style' => 'width: 200px;' ));

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

        
        <?php echo Yii::t('D2companyModule.crud_static','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('D2companyModule.crud_static','Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccmpCompany/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('D2companyModule.crud_static','Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->