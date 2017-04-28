<?php

namespace common\models;

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
 * @property string $quantity
 * @property string $price
 * @property string $note
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deleteAt
 */
class AR extends \yii\db\ActiveRecord
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
            [['idUser', 'idCompany', 'idProduct', 'idWarehouse', 'type'], 'required'],
            [['idUser', 'idCompany', 'idProduct', 'idWarehouse', 'type'], 'integer'],
            [['date', 'createdAt', 'updatedAt', 'deleteAt'], 'safe'],
            [['quantity', 'price'], 'number'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idUser' => Yii::t('app', 'Id User'),
            'idCompany' => Yii::t('app', 'Id Company'),
            'idProduct' => Yii::t('app', 'Id Product'),
            'idWarehouse' => Yii::t('app', 'Id Warehouse'),
            'date' => Yii::t('app', 'Date'),
            'type' => Yii::t('app', 'Type'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'note' => Yii::t('app', 'Note'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deleteAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
