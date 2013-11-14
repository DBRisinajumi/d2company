  <div id="customer-form-wrapper">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

 ?>

<?php 
 
 $this->widget('bootstrap.widgets.TbAlert', array(
'block' => true,
'fade' => true,
'closeText' => '&times;', // false equals no close link
'events' => array(),
'htmlOptions' => array(),
'userComponentId' => 'user',
'alerts' => array( // configurations per alert type
// success, info, warning, error or danger
'success' => array('closeText' => '&times;'),
'info', // you don't need to specify full config
'warning' => array('block' => false, 'closeText' => false),
'error' => array('block' => false, 'closeText' => false)
),
));      
  
     
 ?>

<div class="crud-form">
       <?  
       $action = Yii::app()->createUrl('//Customers/createAjax', array('ccmp_id' => $ccmp_id));
       $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'customer-form',
             'type'=>'inline', 
             'enableAjaxValidation'=>false,
              'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
                             ),
        ));
       
       echo Chtml::hiddenField('ccmp_id',$ccmp_id);

        echo $form->errorSummary($model4update); ?>
       <table class="horizontal-form" >
              
           <tr>
                     
                      
                    <td >
          <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model4update,'username') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model4update,'username',array('size'=>200,'maxlength'=>350));
                           
                            ?>
                            <span class="help-block">
                                
                               
                                                            </span>
                        </div>
                    </div>
                    </td>
                    <td>
                        <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model4update,'email') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model4update,'email',array('size'=>200,'maxlength'=>50));
                           
                            ?>
                            <span class="help-block">
                                
                              
                                                            </span>
                        </div>
                    </div>
                        
                    </td>
                    <td>
         
                    </td>
           </tr>
           <tr>
               <td>
                   <? echo $form->error($model4update,'name') ; ?>
               </td>
               <td>
                   <? echo $form->error($model4update,'email'); ?>
               </td>
              
           </tr>
       </table>
                   
                    <div class="form-actions">  
                    
                         <?php  
                         if($this->action->id == 'updateAjax'){
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
                   
                    </div>    
            
 
    <?php $this->endWidget() ?>
    
</div>

 <script type="text/javascript">
 
function send()
 {
 
   var data=$("#customer-form").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl('/d2company/Customers/createAjax',array('ccmp_id' => $ccmp_id)); ?>',
   data:data,
success:function(data){
    
                 $('#customer-form-wrapper').html(data);
                 $.fn.yiiGridView.update('customer-grid');
                 

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