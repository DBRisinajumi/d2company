<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccxg-company-xgroup-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('crud','Data')?>                <small>
                    <?php //echo $model->itemLabel ?>
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
                            echo $form->error($model,'ccxg_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcxgCompanyXGroup.ccxg_id') != 'CcxgCompanyXGroup.ccxg_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccxg_ccmp_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ccxgCcmp',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ccxg_ccmp_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcxgCompanyXGroup.ccxg_ccmp_id') != 'CcxgCompanyXGroup.ccxg_ccmp_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccxg_ccgr_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ccxgCcgr',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ccxg_ccgr_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('crud', 'CcxgCompanyXGroup.ccxg_ccgr_id') != 'CcxgCompanyXGroup.ccxg_ccgr_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                            </div>
        </div>
        <!-- main inputs -->

        <div class="span5"> <!-- sub inputs -->
            <h2>
                <?php echo Yii::t('crud','Relations')?>
            </h2>
            
                
                

        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">

        
        <?php echo Yii::t('crud','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccxgCompanyXGroup/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->