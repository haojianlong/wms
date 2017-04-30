<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property int $id
 * @property int $idArOut
 * @property int $idArInto
 * @property int $quantity
 * @property string $note
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Transfer extends base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idArOut', 'idArInto', 'quantity'], 'required'],
            [['idArOut', 'idArInto', 'quantity'], 'integer'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
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
            'idArOut' => Yii::t('app', 'Id Ar Out'),
            'idArInto' => Yii::t('app', 'Id Ar Into'),
            'quantity' => Yii::t('app', 'Quantity'),
            'note' => Yii::t('app', 'Note'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
