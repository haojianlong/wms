<?php

use yii\db\Migration;
use yii\db\Schema;

class m130524_201442_init extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			//$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%user}}', [
			'id' => $this->primaryKey(),
			'idRole' => $this->smallInteger()->notNull()->defaultValue(10),
			'username' => $this->string()->notNull()->unique(),
			'auth_key' => $this->string(32)->notNull(),
			'password_hash' => $this->string()->notNull(),
			'password_reset_token' => $this->string()->unique(),
			'email' => $this->string()->notNull()->unique(),
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
			'createdAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updatedAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'deleteAt' => $this->dateTime()->defaultValue(null),
		], $tableOptions);

		$this->createTable('{{%active_record}}', [
			'id' => $this->primaryKey(),
			'idUser' => $this->integer()->notNull(),
			'idCompany' => $this->integer()->notNull(),
			'idProduct' => $this->integer()->notNull(),
			'idWarehouse' => $this->integer()->notNull(),
			'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'type' => $this->smallInteger()->notNull(),
			'quantity' => $this->decimal(18, 5)->unsigned()->notNull()->defaultValue(0),
			'price' => $this->decimal(18, 5)->unsigned()->notNull()->defaultValue(0),
			'createdAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updatedAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'deleteAt' => $this->dateTime()->defaultValue(null),
		], $tableOptions);

		$this->createTable('{{%company}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string(255),
			'contact' => $this->string(255),
			'phone' => $this->string(255),
			'fax' => $this->string(255),
			'email' => $this->string(255),
			'bank' => $this->string(255),
			'bankAccount' => $this->string(255),
			'bankAccount' => $this->string(255),
			'type' => $this->smallInteger()->notNull(),
			'createdAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updatedAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'deleteAt' => $this->dateTime()->defaultValue(null),
		], $tableOptions);

		$this->createTable('{{%company}}', [
			'id' => $this->primaryKey(),
			'createdAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updatedAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'deleteAt' => $this->dateTime()->defaultValue(null),
		], $tableOptions);






































	}

	public function down()
	{
		$this->dropTable('{{%user}}');
	}
}
