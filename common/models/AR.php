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
 * @property boolean $isTransfer
 * @property int $quantity
 * @property string $price
 * @property string $note
 * @property int $type
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Product $product
 * @property User $user
 * @property Company $company
 * @property Warehouse $warehouse
 */
class AR extends \common\models\base\AR
{
    const ENTRY = 1;
    const DISCHARGE = 2;

    public static $type = [
        self::ENTRY => 'Warehouse Entry',
        self::DISCHARGE => 'Warehouse Discharge',
    ];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['quantity', 'limitQuantity'],
            ['idUser', 'default', 'value' => Yii::$app->user->id],
            ['idWarehouse', 'default', 'value' => function($model){
                return $model->product->idWarehouse;
            }],
        ]);
    }

    public function limitQuantity($attribute)
    {
        if ($this->type == self::ENTRY) {
            $quantity = $this->quantity + $this->product->quantity;
            if ($quantity > $this->product->max) {
                $this->addError($attribute, $this->product->min.'d'.$this->product->quantity.'ao '.$this->product->max);
            }
        } elseif ($this->type == self::DISCHARGE) {
            $quantity = $this->product->quantity - $this->quantity;
            if ($quantity < 0) {
                $this->addError($attribute, $this->product->min.'-'.$this->product->max);
            }
            // if ($quantity < $this->product->min) {
            //     $this->addError($attribute, $this->product->min.'-'.$this->product->max);
            // }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'idWarehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'idCompany']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'idProduct']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
