<?php

/**
 * This is the model base class for the table "cucp_user_company_position".
 *
 * Columns in table "cucp_user_company_position" available as properties of the model:
 * @property integer $cucp_id
 * @property string $cucp_name
 *
 * Relations of table "cucp_user_company_position" available as properties of the model:
 * @property CcucUserCompany[] $ccucUserCompanies
 */
abstract class BaseCucpUserCompanyPosition extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'cucp_user_company_position';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('cucp_name', 'required'),
                array('cucp_name', 'length', 'max' => 20),
                array('cucp_id, cucp_name', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->cucp_name;
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
        return array_merge(
            parent::relations(), array(
                'ccucUserCompanies' => array(self::HAS_MANY, 'CcucUserCompany', 'ccuc_cucp_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'cucp_id' => Yii::t('D2companyModule.crud', 'Cucp'),
            'cucp_name' => Yii::t('D2companyModule.crud', 'Cucp Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.cucp_id', $this->cucp_id);
        $criteria->compare('t.cucp_name', $this->cucp_name, true);


        return $criteria;

    }

}
