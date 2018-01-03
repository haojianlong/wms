<?php

namespace common\models\base;

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
 * @property string $deletedAt
 */
class Warehouse extends Base
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
            ['id', 'integer'],
            [['idType', 'idLocation', 'name', 'code', 'address'], 'required'],
            [['idType', 'idLocation', 'status'], 'integer'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
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
            'idType' => Yii::t('app', 'Type'),
            'idLocation' => Yii::t('app', 'Location'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'address' => Yii::t('app', 'Address'),
            'remark' => Yii::t('app', 'Remark'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
