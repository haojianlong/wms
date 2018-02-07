<?php

namespace common\models\base\traits;

use yii\web\BadRequestHttpException;

trait ConstantTrait
{
    /**
     * @param string $constant
     * @param string $limit
     * @return bool
     * @throws BadRequestHttpException
     */
    public static function checkConstant($constant, $limit = '')
    {
        if (!is_string($limit)) {
            throw new BadRequestHttpException();
        }
        $reflection = new \ReflectionClass(__CLASS__);
        $constants = $reflection->getConstants();
        foreach ($constants as $k => $v) {
            if ($v == $constant && (empty($limit) || strpos($k, $limit) === 0)) {
                return true;
            }
        }
        return false;
    }
}
