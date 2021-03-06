<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $idType
 * @property int $idWarehouse
 * @property int $max
 * @property int $min
 * @property int $quantity
 * @property string $name
 * @property string $sku
 * @property string $barcode
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Product extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['idType', 'idWarehouse', 'max', 'name', 'sku', 'barcode'], 'required'],
            [['idType', 'idWarehouse', 'max', 'min', 'quantity'], 'integer'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name', 'sku', 'barcode', 'remark'], 'string', 'max' => 255],
            ['min', 'compare', 'type'=> 'number', 'compareAttribute' =>'max', 'operator' => '<'],
            ['quantity', 'compare', 'type'=> 'number', 'compareAttribute' =>'max', 'operator' => '<='],
            [['idType'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['idType' => 'id']],
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
            'idWarehouse' => Yii::t('app', 'Warehouse'),
            'max' => Yii::t('app', 'Max'),
            'min' => Yii::t('app', 'Min'),
            'quantity' => Yii::t('app', 'Quantity'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'barcode' => Yii::t('app', 'Barcode'),
            'remark' => Yii::t('app', 'Remark'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
