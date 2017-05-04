<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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

    /**
     * @return array $names
     */
    public static function getNames()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['idType' => 'id']);
    }
}
