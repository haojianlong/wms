<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property int $idType
 * @property int $idLocation
 * @property int $status
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deleteAt
 *
 * @property Location $location
 * @property WarehouseType $type0
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idType', 'idLocation', 'name', 'code', 'address'], 'required'],
            [['idType', 'idLocation', 'status'], 'integer'],
            [['createdAt', 'updatedAt', 'deleteAt'], 'safe'],
            [['name', 'code', 'address', 'remark'], 'string', 'max' => 255],
            [['idLocation'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['idLocation' => 'id']],
            [['idType'], 'exist', 'skipOnError' => true, 'targetClass' => WarehouseType::className(), 'targetAttribute' => ['idType' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idType' => Yii::t('app', 'Id Type'),
            'idLocation' => Yii::t('app', 'Id Location'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'address' => Yii::t('app', 'Address'),
            'remark' => Yii::t('app', 'Remark'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deleteAt' => Yii::t('app', 'Delete At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'idLocation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(WarehouseType::className(), ['id' => 'idType']);
    }
}
