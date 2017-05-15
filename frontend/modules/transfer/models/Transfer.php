<?php

namespace frontend\modules\transfer\models;

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
class Transfer extends \common\models\Transfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['date', 'quantity'], 'required'],
            [['idArOut', 'idArInto', 'quantity','date', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['note'], 'string', 'max' => 255],
        ];
    }
}
