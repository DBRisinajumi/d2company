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

<? $model4update = new User;


//form
?> <div id="branch-form-add" style="display:none;">    <?

 $this->renderPartial('/Customers/_form_horizontal_ajax', array(
               'model4update' => $model4update,
               'ccmp_id' => $ccmp_id     
        ));
 
 ?> </div>    <?
 


//grid
 

 
 $this->renderPartial('/Customers/_customer_grid', array(
            'ccmp_id' => $ccmp_id, 'model4grid' => $model4grid
            
        ));

?>


