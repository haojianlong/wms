<?php

namespace common\models;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property int $status
 * @property string $name
 * @property string $address
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Warehouse[] $warehouses
 * @array name[] $names
 */
class Location extends \common\models\base\Location
{
    use base\traits\ArrayNameTrait;

    const STATUS_CLOSED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var array
     */
    public static $status = [
        self::STATUS_CLOSED => 'CLOSED',
        self::STATUS_ACTIVE => 'ACTIVE',
    ];

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['idLocation' => 'id']);
    }

}
