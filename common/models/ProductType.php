<?php

namespace common\models;

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
 * @array ProductType[] $parents 所有父类型
 * @property ProductType $parent 所在父类型
 * @array name[] $names
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
    public static function getParents($id = null)
    {
        $parents = [0 => 'Default'] + ArrayHelper::map(self::find()->where(['idParent' => 0])->filterWhere(['<>', 'id', $id])->asArray()->all(),'id', 'name');
        return $parents;
    }

    /**
     * @param null $idParent
     * @return array 获取子类型[id => name]
     */
    public static function getNames($idParent = null)
    {
        $find = self::find()->asArray();
        if ($idParent == 0) {
            $find->where(['<>', 'idParent', 0]);
        } else {
            $find->filterWhere(['idParent' => $idParent]);
        }

        $parents = ArrayHelper::map($find->all(), 'id', 'name');

        return $parents;
    }

    /**
     * @return ProductType|array|null
     */
    public function getParent()
    {
        return self::findOne($this->idParent);
    }
}
