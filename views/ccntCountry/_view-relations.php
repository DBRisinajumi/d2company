
    <h2>
        <?php echo Yii::t('crud','Relations') ?>    </h2>

    
        <?php 
        echo '<h3>CcmpCompanies ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'mini',
                    'buttons'=>array(
                        array(
                            'icon'=>'icon-list-alt',
                            'url'=> array('//d2company/ccmpCompany/admin')
                        ),
                        array(
                'icon'=>'icon-plus',
                'url'=>array(
                    '//d2company/ccmpCompany/create',
                    'CcmpCompany' => array('ccmp_ccnt_id'=>$model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
        <ul>

            <?php
            $records = $model->ccmpCompanies(array('limit'=>250));
            if (is_array($records)) {
                foreach($records as $i => $relatedModel) {
                    echo '<li>';
                    echo CHtml::link(
                        '<i class="icon icon-arrow-right"></i> '.$relatedModel->itemLabel,
                        array('/d2company/ccmpCompany/view','ccmp_id'=>$relatedModel->ccmp_id)
                    );
                    echo CHtml::link(
                        ' <i class="icon icon-pencil"></i>',
                        array('/d2company/ccmpCompany/update','ccmp_id'=>$relatedModel->ccmp_id)
                    );
                    echo '</li>';
                }
            }
            ?>
        </ul>

    