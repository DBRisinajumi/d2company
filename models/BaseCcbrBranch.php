<?php

/**
 * This is the model base class for the table "ccbr_branch".
 *
 * Columns in table "ccbr_branch" available as properties of the model:
 * @property string $ccbr_id
 * @property string $ccbr_ccmp_id
 * @property string $ccbr_name
 * @property string $ccrb_code
 * @property string $ccbr_notes
 * @property integer $ccbr_hide
 *
 * Relations of table "ccbr_branch" available as properties of the model:
 * @property CcmpCompany $ccbrCcmp
 */
abstract class BaseCcbrBranch extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccbr_branch';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccbr_ccmp_id, ccbr_name', 'required'),
                array('ccrb_code, ccbr_notes, ccbr_hide', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccbr_hide', 'numerical', 'integerOnly' => true),
                array('ccbr_ccmp_id', 'length', 'max' => 10),
                array('ccbr_name', 'length', 'max' => 350),
                array('ccrb_code', 'length', 'max' => 50),
                array('ccbr_notes', 'safe'),
                array('ccbr_id, ccbr_ccmp_id, ccbr_name, ccrb_code, ccbr_notes, ccbr_hide', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccbr_ccmp_id;
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
            'ccbrCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccbr_ccmp_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccbr_id' => Yii::t('d2companyModule.crud', 'Ccbr'),
            'ccbr_ccmp_id' => Yii::t('d2companyModule.crud', 'Ccbr Ccmp'),
            'ccbr_name' => Yii::t('d2companyModule.crud', 'Ccbr Name'),
            'ccrb_code' => Yii::t('d2companyModule.crud', 'Ccrb Code'),
            'ccbr_notes' => Yii::t('d2companyModule.crud', 'Ccbr Notes'),
            'ccbr_hide' => Yii::t('d2companyModule.crud', 'Ccbr Hide'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccbr_id', $this->ccbr_id, true);
        $criteria->compare('t.ccbr_ccmp_id', $this->ccbr_ccmp_id);
        $criteria->compare('t.ccbr_name', $this->ccbr_name, true);
        $criteria->compare('t.ccrb_code', $this->ccrb_code, true);
        $criteria->compare('t.ccbr_notes', $this->ccbr_notes, true);
        $criteria->compare('t.ccbr_hide', $this->ccbr_hide);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
