<div class="crud-form">
<?php
        $this->widget(
            'TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                array(
                    'label' => Yii::t('D2companyModule.crud', 'Attachments'),
                    'type'   => 'raw',
                    'template'   =>  $this->widget(
                                        'vendor.dbrisinajumi.d1files.widgets.d1Upload',
                                        array(
                                            'controler' => $this,
                                            'model_id' => $model->getPrimaryKey(),
                                            'action' => 'template',
                                            ),
                                        true
                                        ),
                    'value'  => $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("D2companyModule.crud","Add file"),
                        "icon"=>"icon-plusthick",
                        'htmlOptions' => array(
                            'data-toggle' => 'modal',
                            'onclick' => '$("#fileupload").trigger("click");'
                         ),

                    ),true)
                    ,

                ),
            ),
        ));
?>
</div>
