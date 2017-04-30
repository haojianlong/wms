<?php

namespace common\libraries\db;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }
}
