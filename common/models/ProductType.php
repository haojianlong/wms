<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_type".
 *
 * @property int $id
 * @property int $idParent
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Product[] $products
 * @array Parent[] $parents
 * @property Parent $parent
 */
class ProductType extends \common\models\base\ProductType
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['idType' => 'id']);
    }

    /**
     * @return array $parents
     */
    public function getParents()
    {
        $parents = [0 => Yii::t('app', 'not set')] + ArrayHelper::map(self::find()->where(['idParent' => 0])->asArray()->all(),'id', 'name');
        unset($parents[$this->id]);
        return $parents;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return self::findOne($this->idParent);
    }
}
