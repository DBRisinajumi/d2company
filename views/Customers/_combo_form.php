<div class="btn-toolbar" id="form_sh_buttons">
<? 
/**
 * @todo epasta nosūtīšana, ja statusu uzliek user un nav pieeja & paziņo par nosūtīšanu
 * @todo pielāgot jaunajam ccuc klienta kabinetu
 */
if (!isset($_GET['isAjaxRequest'])) {
    Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
    Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
    Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

    //ajax link for forms
    $ajax_url = $this->createUrl('',array(
        'ccmp_id'=>$ccmp_id,
        'isAjaxRequest'=>'1',
        ));
    
    //for form submit as ajax
    Yii::app()->clientScript->registerScript('send_form', "
    function send_form(form_id)
    {

      var data=$('#'+form_id).serialize();

      $.ajax({
            type: 'POST',
            url: '". $ajax_url . "',
            data:data,
            success:function(data){
                    $('#reload_by_ajax').html(data); 
                  },
            error: function(data) { // if error occured
             alert('Error occured.please try again');
             alert(data);
        },
         dataType:'html'
      });

    }
    ",CClientScript::POS_END);        

    Yii::app()->clientScript->registerScript('add', "
        $('#form_sh_buttons .new-person').on('click',function(){
            $('#branch-form-add-new').toggle();
            $('#branch-form-add-exist').hide();        
            return false;
        });
        $('#form_sh_buttons .exist-person').on('click',function(){    
            $('#branch-form-add-exist').toggle();
            $('#branch-form-add-new').hide();
            return false;
        });
        $('div.form-actions .cancel').on('click',function(){        
            $('#branch-form-add-exist').hide();
            $('#branch-form-add-new').hide();
            return false;
        });
    ");

    $this->widget(
        "bootstrap.widgets.TbButton",
        array(
            "label"=>Yii::t('D2companyModule.crud','Add new person'),
            "icon"=>"icon-plus",
            "htmlOptions"=>array("class"=>"add-button new-person")
             )
    );
    $this->widget(
        "bootstrap.widgets.TbButton",
        array(
            "label"=>Yii::t('D2companyModule.crud','Add existing person'),
            "icon"=>"icon-plus",
            "htmlOptions"=>array("class"=>"add-button exist-person")
             )
    );
}
?>
</div>
<div id="reload_by_ajax">
<? $model4newuser = new User;
   $model4newprofile = new Profile;

//form
?> 
<div id="branch-form-add-new" clas="cuuc_form" style="display:none;">    
<?
  $this->renderPartial("/Customers/_form", array('ccmp_id' => $ccmp_id, 'model' => $model_person)); 
 ?> 
</div>
<?
?> 
<div id="branch-form-add-exist" clas="cuuc_form" style="display:none;">    
<?
  $this->renderPartial("/Customers/_exist_form", array('ccmp_id' => $ccmp_id, 'model' => $model_cucc_new)); 
 ?> 
</div>
<?

//grid
 $this->renderPartial('/Customers/_admin', array(
            'ccmp_id' => $ccmp_id, 'model' => $modelCcuc
            
        ));
 ?>
</div>