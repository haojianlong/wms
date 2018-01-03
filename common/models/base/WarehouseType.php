<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "warehouse_type".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Warehouse[] $warehouses
 */
class WarehouseType extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Delete At'),
        ];
    }
}
