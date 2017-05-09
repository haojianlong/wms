<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property User[] $users
 */
class Role extends \common\models\base\Role
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idRole' => 'id']);
    }
}
