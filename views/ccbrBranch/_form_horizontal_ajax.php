<?php
$modelBfst = new BfstFuelStation();
Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
Yii::app()->clientScript->registerScript('crud/variant/update', '$(".crud-form select").select2();');

?>
<div id="branch-form-wrapper">

    <div class="crud-form">
    <?php
    $action = Yii::app()->createUrl('//ccbrBranch/createAjax', array('ccmp_id' => $ccmp_id));
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'branch-form',
        'type' => 'inline',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'onsubmit' => "return false;", /* Disable normal form submit */
            'onkeypress' => " if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
        ),
    ));

    echo $form->hiddenField($model4update, 'ccbr_ccmp_id');

    echo $form->errorSummary($model4update);
    ?>

                    <div class="control-group">
                        <div class='control-label'>
                            <?=$form->labelEx($model4update, 'ccbr_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            //echo $form->textField($model4update, 'ccbr_name', array('size' => 60, 'maxlength' => 350));
                            
                            $branches = CcbrBranch::model()->findAllByAttributes(['ccbr_ccmp_id' => $model4update->ccbr_ccmp_id] );
                            $branchesBfstId = CHtml::listData($branches,'ccbr_id','ccbr_bfst_id');
                            
                            $criteria = new CDbCriteria;
                            $criteria->addNotInCondition('bfst_id', $branchesBfstId);
                            $criteria->order = 'bfst_name'; 
                            $stations = BfstFuelStation::model()->findAll($criteria);
                            $bfstListData = CHtml::listData($stations, 'bfst_id', 'bfst_name');
                            echo $form->listBox($modelBfst,'bfst_id',$bfstListData,array('class'=>'span3'));
                            ?>
                            <span class="help-block">

                            <?php
                            echo ($t = Yii::t('crud', 'CcbrBranch.ccbr_name') != 'CcbrBranch.ccbr_name') ? $t : ''
                            ?>
                            </span>
                        </div>
                    </div>


               

        <div class="form-actions">  

                    <?php
                    if ($this->action->id == 'updateAjax') {
                        echo CHtml::Button(
                                Yii::t('D2companyModule.crud_static', 'Cancel'), array(
                            'submit' => array('bcbdCompanyBranchDay/view',),
                            'class' => 'btn'
                        )) . ' ';
                    }
                    echo CHtml::submitButton(
                            Yii::t('D2companyModule.crud_static', 'Add'), array('class' => 'btn btn-primary', 'onclick' => 'send();')
                    );
                    ;
                    ?>

        </div>    


            <?php $this->endWidget() ?>

    </div>

    <script type="text/javascript">

        function send()
        {

            var data = $("#branch-form").serialize();


            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl('/d2company/ccbrBranch/createAjax', array('ccmp_id' => $ccmp_id)); ?>',
                data: data,
                success: function (data) {

                    $('#branch-form-wrapper').html(data);
                    $.fn.yiiGridView.update('branch-grid-company');


                },
                error: function (data) { // if error occured
                    alert("Error occured.please try again");
                    alert(data);
                },
                dataType: 'html'
            });

        }

    </script>

</div>