<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
 *
 * @property Location $location
 * @array name[] $names
 * @property WarehouseType $type
 */
class Warehouse extends \common\models\base\Warehouse
{
    const STATUS_CLOSED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var array
     */
    public static $status = [
        self::STATUS_ACTIVE => 'ACTIVE',
        self::STATUS_CLOSED => 'CLOSED',
    ];

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
    public function getType()
    {
        return $this->hasOne(WarehouseType::className(), ['id' => 'idType']);
    }

    /**
     * @return array $names
     */
    public static function getNames()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id', 'name');
    }
}
