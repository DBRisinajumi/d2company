<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccnt-country-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('D2companyModule.crud_static','Data')?>                <small>
                    <?php echo $model->itemLabel ?>
                </small>

            </h2>


            <div class="form-horizontal">

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <?php
                            ;
                            echo $form->error($model,'ccnt_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcntCountry.ccnt_id') != 'CcntCountry.ccnt_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccnt_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccnt_name',array('size'=>60,'maxlength'=>200));
                            echo $form->error($model,'ccnt_name')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcntCountry.ccnt_name') != 'CcntCountry.ccnt_name')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccnt_code') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccnt_code',array('size'=>3,'maxlength'=>3));
                            echo $form->error($model,'ccnt_code')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcntCountry.ccnt_code') != 'CcntCountry.ccnt_code')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                            </div>
        </div>
        <!-- main inputs -->
        <!-- sub inputs -->
    </div>

    <p class="alert">

        
        <?php echo Yii::t('D2companyModule.crud_static','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('D2companyModule.crud_static','Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccntCountry/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('D2companyModule.crud_static','Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->