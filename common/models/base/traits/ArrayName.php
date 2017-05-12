<?php

namespace common\models\base\traits;

use yii\helpers\ArrayHelper;

trait ArrayName
{
    /**
     * @return array $names
     */
    public static function getNames($condition = [])
    {
        return ArrayHelper::map(self::find()->where($condition)->asArray()->all(),'id', 'name');
    }
}
