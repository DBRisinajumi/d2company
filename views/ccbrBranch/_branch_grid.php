<?php

$ajaxUpdateUrl = Yii::app()->controller->createUrl("/d2company/ccbrBranch/adminAjax", array("ccmp_id" => $ccmp_id));

$this->widget('TbGridView',
    array(
        'id' => 'branch-grid-company',
        'type' => 'bordered condensed stripped',
        'dataProvider' => $model4grid->search(),
        'filter' => $model4grid,
        'ajaxUrl' => $ajaxUpdateUrl,
        'template' => '{items}{summary}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
       'columns' => array(
        array(
            'class' => 'TbEditableColumn',
            'name' => 'ccbr_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                'emptytext' => Yii::t('D2companyModule.crud_static', 'Empty'),
            )
        ),
        array(
            'class' => 'TbEditableColumn',
            'name' => 'ccbr_code',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                'emptytext' => Yii::t('D2companyModule.crud_static', 'Empty'),
            )
        ),
        array(
            'class' => 'TbEditableColumn',
            'name' => 'ccbr_hide',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                'emptytext' => Yii::t('D2companyModule.crud_static', 'Empty'),
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'FALSE'),
                'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcbrBranch.Update")'),
                'delete' => array('visible' => 'TRUE'),
            ),
            //'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccbr_id" => $data->ccbr_id))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateccbr", array("ccbr_id" => $data->ccbr_id,"ccmp_id" => $data->ccbr_ccmp_id))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("ccbrBranch/delete", array("ccbr_id" => $data->ccbr_id))',
        ),
    )
        )
);
?>

<script type="text/javascript">
    jQuery('#bcar-id-grid a.toggleStatus').live('click',function() {
 
        if ($(this).hasClass('disabled'))
            return false;
 
        var th=this;
 
        var afterDelete=function(){};
        $.fn.yiiGridView.update('bcar-id-grid', {
            type:'POST',
            url:$(this).attr('href'),
            success:function(data) {
                $.fn.yiiGridView.update('bcar-id-grid');
                afterDelete(th,true,data);
            },
            error:function(XHR) {
                return afterDelete(th,false,XHR);
            }
        });
 
        return false;
    });
</script>
