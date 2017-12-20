<?php

namespace common\models\base;

use Yii;

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
 */
class User extends Base
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
            ['id', 'integer'],
			[['status'], 'integer'],
			[['username', 'auth_key', 'password_hash', 'email'], 'required'],
			[['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
			[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[['username'], 'unique'],
			[['email'], 'unique'],
			[['password_reset_token'], 'unique'],
			[['idRole'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['idRole' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'idRole' => Yii::t('app', 'Role'),
			'username' => Yii::t('app', 'Username'),
			'auth_key' => Yii::t('app', 'Auth Key'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'password_reset_token' => Yii::t('app', 'Password Reset Token'),
			'email' => Yii::t('app', 'Email'),
			'status' => Yii::t('app', 'Status'),
			'createdAt' => Yii::t('app', 'Created At'),
			'updatedAt' => Yii::t('app', 'Updated At'),
			'deletedAt' => Yii::t('app', 'Delete At'),
		];
	}
}
