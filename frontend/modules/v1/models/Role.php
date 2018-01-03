<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2017/11/27
 * Time: 上午9:52
 */
namespace frontend\modules\v1\models;

class Role extends \common\models\Role
{
    public function fields()
    {
        return [
            'id',
            'name',
            'role'
        ];
    }
}
