<?php

namespace common\models;

/**
 * This is the model class for table "warehouse_type".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Warehouse[] $warehouses
 * @array name[] $names
 */
class WarehouseType extends \common\models\base\WarehouseType
{
    use base\traits\ArrayNameTrait;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['idType' => 'id']);
    }
}
