<?php

namespace common\models\traits;

use yii\db\ActiveQuery;

trait SoftDeleteable
{
    /**
     * @return void
     */
    public function setDeletedAt($time = null)
    {
        $this->deletedAt = isset($time) ? intval($time) : time();
    }

    /**
     * Add a default condition according the param.
     *
     * @param null|boolean $onlyDeleted null -> not deleted, true -> deleted, false -> all
     * @return ActiveQuery
     */
    public static function find($onlyDeleted = null)
    {
        $deletedAt = static::tableName() . '.deletedAt';
        if (is_null($onlyDeleted)) {
            return parent::find()->where([$deletedAt => 0]);
        } elseif ($onlyDeleted === true) {
            return parent::find()->where(['>', $deletedAt, 0]);
        } elseif ($onlyDeleted === false) {
            return parent::find();
        }
    }
}
