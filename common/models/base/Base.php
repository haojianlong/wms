<?php

namespace common\models\base;

use common\libraries\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * class base
 * Set common method
 *
 */
class Base extends \common\libraries\db\ActiveRecord
{
    //use traits\DbDefault;
    use traits\SoftDeleteable;
    use traits\ConstantTrait;

//    对数据库自动保存操作时间，被TimestampBehavior替代操作
//    /**
//     * @inheritdoc
//     */
//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            if (method_exists($this, 'setTime')) {
//                if ($insert) {
//                    $this->setTime('createdAt');
//                }
//                $this->setTime('updatedAt');
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * Add a default condition according the param.
     *
     * @param null | boolean $isdeLeted null -> not deleted, true -> deleted, false -> all
     * @return ActiveQuery | null
     */
    public static function find($isDeleted = null)
    {
        $deletedAt = static::tableName() . '.deletedAt';
        $parent = parent::find();
        if ($isDeleted === false) {

        } elseif ($isDeleted === true) {
            $parent->andWhere(['>', $deletedAt, 0]);
        } else {
            $parent->andWhere([$deletedAt => null]);
        }
        return $parent;
    }
}
