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
 * @property string $date
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Transfer extends Base
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
            [['date', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
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
            'idArOut' => Yii::t('app', 'Out From'),
            'idArInto' => Yii::t('app', 'Into'),
            'date' => Yii::t('app', 'Date'),
            'quantity' => Yii::t('app', 'Quantity'),
            'note' => Yii::t('app', 'Note'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
