<?php

namespace common\models;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $idRole
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Role $role
 */
class User extends \common\models\base\User
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                if (self::find()->count() == 0) {
                    $this->idRole = 1;
                } else {
                    $this->idRole = 2;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'idRole']);
    }
}
