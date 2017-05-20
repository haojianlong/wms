<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

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
	use base\traits\ArrayName;

	const ROLE = 11;
	const ROLE_AR = 1;
	const ROLE_COMPANY = 2;
	const ROLE_COMPANY_TYPE = 3;
	const ROLE_LOCATION = 4;
	const ROLE_PRODUCT = 5;
	const ROLE_TRANSFER = 6;
	const ROLE_USER = 7;
	const ROLE_WAREHOUSE = 8;
	const ROLE_WAREHOUSE_TYPE = 9;
	const ROLE_PRODUCT_TYPE = 10;

	public static $roles = [
		self::ROLE_AR => 'AR',
		self::ROLE_COMPANY => 'Company',
		// self::ROLE_COMPANY_TYPE => 'Company Type',
		self::ROLE_LOCATION => 'Location',
		self::ROLE_PRODUCT => 'Product',
		self::ROLE_TRANSFER => 'Transfer',
		self::ROLE_USER => 'User',
		self::ROLE_WAREHOUSE => 'Warehouse',
		self::ROLE => 'Role',
		// self::ROLE_WAREHOUSE_TYPE => 'Warehouse Type',
		// self::ROLE_PRODUCT_TYPE => 'Product Type',
	];

	/**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (is_array($this->role)) {
            	$this->role = Json::encode($this->role);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idRole' => 'id']);
    }


}
