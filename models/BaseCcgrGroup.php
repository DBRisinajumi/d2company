<?php

/**
 * This is the model base class for the table "ccgr_group".
 *
 * Columns in table "ccgr_group" available as properties of the model:
 * @property integer $ccgr_id
 * @property string $ccgr_name
 * @property string $ccgr_notes
 * @property integer $ccgr_hide
 *
 * Relations of table "ccgr_group" available as properties of the model:
 * @property CcxgCompanyXGroup[] $ccxgCompanyXGroups
 */
abstract class BaseCcgrGroup extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccgr_group';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccgr_name', 'required'),
                array('ccgr_notes, ccgr_hide', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccgr_hide', 'numerical', 'integerOnly' => true),
                array('ccgr_name', 'length', 'max' => 20),
                array('ccgr_notes', 'safe'),
                array('ccgr_id, ccgr_name, ccgr_notes, ccgr_hide', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccgr_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => 'vendor.schmunk42.relation.behaviors.GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array(
            'ccxgCompanyXGroups' => array(self::HAS_MANY, 'CcxgCompanyXGroup', 'ccxg_ccgr_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccgr_id' => Yii::t('D2companyModule.crud', 'Ccgr'),
            'ccgr_name' => Yii::t('D2companyModule.crud', 'Ccgr Name'),
            'ccgr_notes' => Yii::t('D2companyModule.crud', 'Ccgr Notes'),
            'ccgr_hide' => Yii::t('D2companyModule.crud', 'Ccgr Hide'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccgr_id', $this->ccgr_id);
        $criteria->compare('t.ccgr_name', $this->ccgr_name, true);
        $criteria->compare('t.ccgr_notes', $this->ccgr_notes, true);
        $criteria->compare('t.ccgr_hide', $this->ccgr_hide);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
