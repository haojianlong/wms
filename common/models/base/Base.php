<?php

namespace common\models\base;

use Yii;

/**
 * class base
 * Set common method
 *
 */
class Base extends \common\libraries\db\ActiveRecord
{
    use traits\DbDefault;

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (method_exists($this, 'setTime')) {
                if ($insert) {
                    $this->setTime('createdAt');
                }
                $this->setTime('updatedAt');
            }
            return true;
        } else {
            return false;
        }
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
        switch ($isDeleted) {
            case null:
                $parent->andWhere([$deletedAt => null]);
                break;
            case true:
                $parent->andWhere(['>', $deletedAt, 0]);
                break;
            case false:
                //all
                break;
            default:
                $parent = null;
                break;
        }
        return $parent;
    }
}
