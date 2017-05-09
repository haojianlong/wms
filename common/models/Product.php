<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $idType
 * @property int $idWarehouse
 * @property int $max
 * @property int $min
 * @property string $name
 * @property string $sku
 * @property string $barcode
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property ProductType $type
 * @property Warehouse $warehouse
 */
class Product extends \common\models\base\Product
{
    use base\traits\ArrayName;
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'idType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'idWarehouse']);
    }
}
