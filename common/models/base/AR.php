<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "ar".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idCompany
 * @property int $idProduct
 * @property int $idWarehouse
 * @property string $date
 * @property int $type
 * @property boolean $isTransfer
 * @property int $quantity
 * @property string $price
 * @property string $note
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class AR extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['idCompany', 'idProduct', 'type', 'quantity'], 'required'],
            [['quantity', 'idUser', 'idCompany', 'idProduct', 'idWarehouse', 'type'], 'integer'],
            [['date', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['price'], 'number'],
            [['note'], 'string', 'max' => 255],
            [['isTransfer'], 'boolean', 'trueValue' => true, 'falseValue' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idUser' => Yii::t('app', 'User'),
            'idCompany' => Yii::t('app', 'Company'),
            'idProduct' => Yii::t('app', 'Product'),
            'idWarehouse' => Yii::t('app', 'Warehouse'),
            'date' => Yii::t('app', 'Date'),
            'type' => Yii::t('app', 'Type'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'note' => Yii::t('app', 'Note'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
