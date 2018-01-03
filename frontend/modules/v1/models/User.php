<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2017/11/27
 * Time: 上午9:52
 */
namespace frontend\modules\v1\models;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'id',
            'name' => 'username',
            'email',
            'role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'idRole']);
    }
}
