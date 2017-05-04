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
        $parents = [0 => Yii::t('app', 'not set')] + ArrayHelper::map(self::find()->where(['idParent' => 0])->filterWhere(['<>', 'id', $id])->asArray()->all(),'id', 'name');
        return $parents;
    }

    /**
     * @return array $names
     */
    public static function getNames($idParent = null)
    {
        $parents = ArrayHelper::map(self::find()->filterWhere(['idParent' => $idParent])->asArray()->all(),'id', 'name');
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
