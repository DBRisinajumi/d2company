<div class="crud-form">

    <?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <div class="form-horizontal">
                <table>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
                <?php
                var_dump($model);
                if(false){
                $this->widget('TbGridView', array(
                    'id' => 'ccmp-ccuc-grid',
                    'dataProvider' => $model,
                    'template' => '{items}{summary}{pager}',
                    'pager' => array(
                        'class' => 'TbPager',
                        'displayFirstAndLast' => true,
                    ),
                    'columns' => array(
                        array(
                            'name' => 'ccuc_user_id',
                            'header' => Yii::t('d2companyModule.crud', 'user_id'),
                        ),
                    ),
                        )
                );
                }
                ?>
            </div>
        </div>
    </div>
    <?php $form = $this->endWidget(); ?>
</div>
