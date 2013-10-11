
    <h2>
        <?php echo Yii::t('d2companyModule.crud_static','Relations') ?>    </h2>

    
        <?php 
        echo '<h3>CcxgCompanyXGroups ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'mini',
                    'buttons'=>array(
                        array(
                            'icon'=>'icon-list-alt',
                            'url'=> array('//d2company/ccxgCompanyXGroup/admin')
                        ),
                        array(
                'icon'=>'icon-plus',
                'url'=>array(
                    '//d2company/ccxgCompanyXGroup/create',
                    'CcxgCompanyXGroup' => array('ccxg_ccgr_id'=>$model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
        <ul>

            <?php
            $records = $model->ccxgCompanyXGroups(array('limit'=>250));
            if (is_array($records)) {
                foreach($records as $i => $relatedModel) {
                    echo '<li>';
                    echo CHtml::link(
                        '<i class="icon icon-arrow-right"></i> '.$relatedModel->itemLabel,
                        array('/d2company/ccxgCompanyXGroup/view','ccxg_id'=>$relatedModel->ccxg_id)
                    );
                    echo CHtml::link(
                        ' <i class="icon icon-pencil"></i>',
                        array('/d2company/ccxgCompanyXGroup/update','ccxg_id'=>$relatedModel->ccxg_id)
                    );
                    echo '</li>';
                }
            }
            ?>
        </ul>

    