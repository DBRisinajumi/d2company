

 <div id="branch-form-wrapper">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

 ?>

<?php 
 
       
  
     
 ?>

<div class="crud-form">
       <?  
        $action = Yii::app()->createUrl('//ccbrBranch/createAjax', array('ccmp_id' => $ccmp_id));
       $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'branch-form',
           
             'enableAjaxValidation'=>true,
              'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
                             ),
        ));
       
       echo $form->hiddenField($model4update,'ccbr_ccmp_id');

        echo $form->errorSummary($model4update);
    ?>
           <table class="horizontal-form" >
              
           <tr>
                     
                      
                    <td style="width: 100px;">
                       <?php echo $form->labelEx($model4update, 'ccbr_name') ?>
                            <?php
                            echo $form->textField($model4update, 'ccbr_name', array('style' => "width:200px;", 'maxlength' => 255));
                          
                            ?>
                     </td>
                     <td style="width: 100px;">
                       <?php echo $form->labelEx($model4update, 'ccbr_code') ?>
                            <?php
                            echo $form->textField($model4update, 'ccbr_code', array('style' => "width:100px;", 'maxlength' => 255));
                          
                            ?>
                     </td>
                     
                      <td style="width: 100px;">
                       <?php echo $form->labelEx($model4update, 'ccbr_notes') ?>
                            <?php
                            echo $form->textField($model4update, 'ccbr_notes', array('style' => "width:200px;", 'maxlength' => 255));
                          
                            ?>
                     </td>
                     
                     <td>&nbsp;<br/>
                         <?php  
                         if($this->action->id == 'updateBfrf'){
                         echo CHtml::Button(
                                 Yii::t('FuelingModule.crud_static', 'Cancel'), array(
                             'submit' => array('bcbdCompanyBranchDay/view', ),
                             'class' => 'btn'
                         )) . ' ';
                         }
                         echo CHtml::submitButton(
                                 Yii::t('D2companyModule.crud_static', 'Add'), array('class' => 'btn btn-primary','onclick'=>'send();')
                         );
                        ;?>
                     </td>
                  </tr>   
                  <tr>
                       <td>
                          <?echo $form->error($model4update,'ccbr_name');?>
                       </td>
                       <td>
                          <?echo $form->error($model4update,'ccbr_code');?>
                       </td>
                        <td>
                          <?echo $form->error($model4update,'ccbr_notes');?>
                       </td>
                       <td></td>
                       
               </tr> 
             
           </table>
 
    <?php $this->endWidget() ?>
    
</div>

 <script type="text/javascript">
 
function send()
 {
 
   var data=$("#branch-form").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl('/d2company/ccbrBranch/createAjax',array('ccmp_id' => $ccmp_id)); ?>',
   data:data,
success:function(data){
    
                 $('#branch-form-wrapper').html(data);
                 $.fn.yiiGridView.update('branch-grid-company');
                 

              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         alert(data);
    },
 
  dataType:'html'
  });
 
}
 
</script>

 </div>

