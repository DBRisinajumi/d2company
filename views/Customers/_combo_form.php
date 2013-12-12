<?php
Yii::app()->clientScript->registerScript('add', "
    $('.add-button').click(function(){
        $('#branch-form-add').toggle();
        return false;
    });
   
    ");

?>
<div class="btn-toolbar">
    
    

<? 



$this->widget(
                   "bootstrap.widgets.TbButton",
                   array(
                       "label"=>Yii::t('d2companyModule.crud_static','Add'),
                "icon"=>"icon-plus",
                "htmlOptions"=>array("class"=>"add-button")
               )
           );

?>
</div>

<? $model4newuser = new User;
   $model4newprofile = new Profile;

//form
?> <div id="branch-form-add" style="display:none;">    <?

  $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4updateuser' => $model4newuser,'model4updateprofile' => $model4newprofile)); 
 
 ?> </div>    <?
 


//grid
 

 
 $this->renderPartial('/Customers/_customer_grid', array(
            'ccmp_id' => $ccmp_id, 'model4grid' => $model4grid
            
        ));

?>


