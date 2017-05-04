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
 */
class Product extends \common\models\base\Product
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'idType']);
    }
}
