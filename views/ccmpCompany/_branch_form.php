<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccbr-branch-form',
            'enableAjaxValidation'=>false,
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
                            echo $form->error($model,'ccbr_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcbrBranch.ccbr_id') != 'CcbrBranch.ccbr_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccbr_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccbr_name',array('size'=>60,'maxlength'=>350));
                            echo $form->error($model,'ccbr_name')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcbrBranch.ccbr_name') != 'CcbrBranch.ccbr_name')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccrb_code') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccrb_code',array('size'=>50,'maxlength'=>50));
                            echo $form->error($model,'ccrb_code')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcbrBranch.ccrb_code') != 'CcbrBranch.ccrb_code')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccbr_notes') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model,'ccbr_notes',array('rows'=>6, 'cols'=>50));
                            echo $form->error($model,'ccbr_notes')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcbrBranch.ccbr_notes') != 'CcbrBranch.ccbr_notes')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccbr_hide') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccbr_hide');
                            echo $form->error($model,'ccbr_hide')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcbrBranch.ccbr_hide') != 'CcbrBranch.ccbr_hide')?$t:''
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

        
        <?php echo Yii::t('d2companyModule.crud_static','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('d2companyModule.crud_static','Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccbrBranch/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('d2companyModule.crud_static','Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->