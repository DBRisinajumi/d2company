<?php

/**
 * This is the model base class for the table "ccit_city".
 *
 * Columns in table "ccit_city" available as properties of the model:
 * @property string $ccit_id
 * @property string $ccit_name
 * @property integer $ccit_ccnt_id
 *
 * Relations of table "ccit_city" available as properties of the model:
 * @property CcntCountry $ccitCcnt
 */
abstract class BaseCcitCity extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccit_city';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccit_name, ccit_ccnt_id', 'required'),
                array('ccit_ccnt_id', 'numerical', 'integerOnly' => true),
                array('ccit_name', 'length', 'max' => 200),
                array('ccit_id, ccit_name, ccit_ccnt_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccit_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array(
            'ccitCcnt' => array(self::BELONGS_TO, 'CcntCountry', 'ccit_ccnt_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccit_id' => Yii::t('D2companyModule.crud', 'Ccit'),
            'ccit_name' => Yii::t('D2companyModule.crud', 'Ccit Name'),
            'ccit_ccnt_id' => Yii::t('D2companyModule.crud', 'Ccit Ccnt'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccit_id', $this->ccit_id, true);
        $criteria->compare('t.ccit_name', $this->ccit_name, true);
        $criteria->compare('t.ccit_ccnt_id', $this->ccit_ccnt_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
