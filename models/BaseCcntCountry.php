<?php

/**
 * This is the model base class for the table "ccnt_country".
 *
 * Columns in table "ccnt_country" available as properties of the model:
 * @property integer $ccnt_id
 * @property string $ccnt_name
 * @property string $ccnt_code
 * @property string $ccnt_icao_a2
 * @property string $ccnt_icao_a3
 * @property string $ccnt_icao_n3
 *
 * Relations of table "ccnt_country" available as properties of the model:
 * @property CcitCity[] $ccitCities
 * @property CcmpCompany[] $ccmpCompanies
 */
abstract class BaseCcntCountry extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccnt_country';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccnt_name', 'required'),
                array('ccnt_code, ccnt_icao_a2, ccnt_icao_a3, ccnt_icao_n3', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccnt_name', 'length', 'max' => 200),
                array('ccnt_code, ccnt_icao_a3, ccnt_icao_n3', 'length', 'max' => 3),
                array('ccnt_icao_a2', 'length', 'max' => 2),
                array('ccnt_id, ccnt_name, ccnt_code, ccnt_icao_a2, ccnt_icao_a3, ccnt_icao_n3', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccnt_name;
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
            'ccitCities' => array(self::HAS_MANY, 'CcitCity', 'ccit_ccnt_id'),
            'ccmpCompanies' => array(self::HAS_MANY, 'CcmpCompany', 'ccmp_ccnt_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccnt_id' => Yii::t('d2companyModule.crud', 'Ccnt'),
            'ccnt_name' => Yii::t('d2companyModule.crud', 'Ccnt Name'),
            'ccnt_code' => Yii::t('d2companyModule.crud', 'Ccnt Code'),
            'ccnt_icao_a2' => Yii::t('d2companyModule.crud', 'Ccnt Icao A2'),
            'ccnt_icao_a3' => Yii::t('d2companyModule.crud', 'Ccnt Icao A3'),
            'ccnt_icao_n3' => Yii::t('d2companyModule.crud', 'Ccnt Icao N3'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccnt_id', $this->ccnt_id);
        $criteria->compare('t.ccnt_name', $this->ccnt_name, true);
        $criteria->compare('t.ccnt_code', $this->ccnt_code, true);
        $criteria->compare('t.ccnt_icao_a2', $this->ccnt_icao_a2, true);
        $criteria->compare('t.ccnt_icao_a3', $this->ccnt_icao_a3, true);
        $criteria->compare('t.ccnt_icao_n3', $this->ccnt_icao_n3, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
