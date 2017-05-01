<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $idType
 * @property string $name
 * @property string $contact
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $bank
 * @property string $bankAccount
 * @property string $tariff
 * @property string $zone
 * @property string $address
 * @property string $zipcode
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Company extends base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idType', 'name', 'contact', 'phone', 'fax', 'email', 'bank', 'bankAccount', 'zone', 'address', 'zipcode'], 'required'],
            [['idType'], 'integer'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name', 'contact', 'phone', 'fax', 'email', 'bank', 'bankAccount', 'tariff', 'zone', 'address', 'zipcode', 'remark'], 'string', 'max' => 255],
            [['idType'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyType::className(), 'targetAttribute' => ['idType' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idType' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'contact' => Yii::t('app', 'Contact'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'bank' => Yii::t('app', 'Bank'),
            'bankAccount' => Yii::t('app', 'Bank Account'),
            'tariff' => Yii::t('app', 'Tariff'),
            'zone' => Yii::t('app', 'Zone'),
            'address' => Yii::t('app', 'Address'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'remark' => Yii::t('app', 'Remark'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
