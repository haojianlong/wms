<?php

namespace common\models\base\traits;

use yii\helpers\ArrayHelper;

trait ArrayName
{
    /**
     * @return array $names
     */
    public static function getNames()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id', 'name');
    }
}
