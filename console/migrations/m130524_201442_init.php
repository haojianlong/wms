<?php

use yii\db\Migration;
use yii\db\Schema;

class m130524_201442_init extends Migration
{

	public function up()
	{
		$default = [
			'createdAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updatedAt' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'deleteAt' => $this->dateTime()->defaultValue(null),
		];
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			//$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%role}}', array_merge([
			'id' => $this->primaryKey(),
			'name' => $this->string(255),
			'role' => $this->string(255),
		], $default), $tableOptions);
		$this->insert('{{%role}}', [
			'name' => 'default',
			'role' => json_encode([]),
		]);
		$this->insert('{{%role}}', [
			'name' => 'admin',
			'role' => json_encode([]),
		]);
		$this->createTable('{{%user}}', array_merge([
			'id' => $this->primaryKey(),
			'idRole' => $this->integer()->notNull()->defaultValue(1),
			'username' => $this->string()->notNull()->unique(),
			'auth_key' => $this->string(32)->notNull(),
			'password_hash' => $this->string()->notNull(),
			'password_reset_token' => $this->string()->unique(),
			'email' => $this->string()->notNull()->unique(),
			'status' => $this->smallInteger()->notNull()->defaultValue(1),
		], $default), $tableOptions);
		$this->createIndex('idx-idRole', '{{%user}}', ['idRole']);
		$this->addForeignKey('{{%fk-user-idRole}}', '{{%user}}', 'idRole', '{{%role}}', 'id');

		$this->createTable('{{%company_type}}', array_merge([
			'id' => $this->primaryKey(),
			'name' => $this->string(255),
		], $default), $tableOptions);

		$this->createTable('{{%warehouse_type}}', array_merge([
			'id' => $this->primaryKey(),
			'name' => $this->string(255),
		], $default), $tableOptions);

		$this->createTable('{{%product_type}}', array_merge([
			'id' => $this->primaryKey(),
			'idParent' => $this->integer()->notNull()->defaultValue(0),
			'name' => $this->string(255)->notNull(),
		], $default), $tableOptions);

		$this->createTable('{{%company}}', array_merge([
			'id' => $this->primaryKey(),
			'idType' => $this->integer()->notNull(),
			'name' => $this->string(255)->notNull(),
			'contact' => $this->string(255)->notNull(),
			'phone' => $this->string(255)->notNull(),
			'fax' => $this->string(255)->notNull(),
			'email' => $this->string(255)->notNull(),
			'bank' => $this->string(255)->notNull(),
			'bankAccount' => $this->string(255)->notNull(),
			'tariff' => $this->string(255),
			'zone' => $this->string(255)->notNull(),
			'address' => $this->string(255)->notNull(),
			'zipcode' => $this->string(255)->notNull(),
			'remark' => $this->string(255),
		], $default), $tableOptions);
		$this->createIndex('idx-idType', '{{%company}}', ['idType']);
		$this->addForeignKey('{{%fk-company-idType}}', '{{%company}}', 'idType', '{{%company_type}}', 'id');

		$this->createTable('{{%location}}', array_merge([
			'id' => $this->primaryKey(),
			'status' => $this->smallInteger()->notNull(),
			'name' => $this->string(255)->notNull(),
			'address' => $this->string(255)->notNull(),
			'remark' => $this->string(255),
		], $default), $tableOptions);

		$this->createTable('{{%warehouse}}', array_merge([
			'id' => $this->primaryKey(),
			'idType' => $this->integer()->notNull(),
			'idLocation' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull()->defaultValue(1),
			'name' => $this->string(255)->notNull(),
			'code' => $this->string(255)->notNull(),
			'address' => $this->string(255)->notNull(),
			'remark' => $this->string(255),
		], $default), $tableOptions);
		$this->createIndex('idx-idType', '{{%warehouse}}', ['idType']);
		$this->addForeignKey('{{%fk-warehouse-idType}}', '{{%warehouse}}', 'idType', '{{%warehouse_type}}', 'id');
		$this->createIndex('idx-idLocation', '{{%warehouse}}', ['idLocation']);
		$this->addForeignKey('{{%fk-warehouse-idLocation}}', '{{%warehouse}}', 'idLocation', '{{%location}}', 'id');

		$this->createTable('{{%product}}', array_merge([
			'id' => $this->primaryKey(),
			'idType' => $this->integer()->notNull(),
			'idWarehouse' => $this->integer()->notNull(),
			'max' => $this->integer()->notNull(),
			'min' => $this->integer()->notNull()->defaultValue(0),
			'name' => $this->string(255)->notNull(),
			'sku' => $this->string(255)->notNull(),
			'barcode' => $this->string(255)->notNull(),
			'remark' => $this->string(255),
		], $default), $tableOptions);
		$this->createIndex('idx-idType', '{{%product}}', ['idType']);
		$this->addForeignKey('{{%fk-product-idType}}', '{{%product}}', 'idType', '{{%product_type}}', 'id');

		$this->createTable('{{%ar}}', array_merge([
			'id' => $this->primaryKey(),
			'idUser' => $this->integer()->notNull(),
			'idCompany' => $this->integer()->notNull(),
			'idProduct' => $this->integer()->notNull(),
			'idWarehouse' => $this->integer()->notNull(),
			'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'type' => $this->smallInteger()->notNull(),
			'quantity' => $this->decimal(18, 5)->unsigned()->notNull()->defaultValue(0),
			'price' => $this->decimal(18, 5)->unsigned()->notNull()->defaultValue(0),
			'note' => $this->string(255),
		], $default), $tableOptions);


		$this->createTable('{{%transfer}}', array_merge([
			'id' => $this->primaryKey(),
			'idArOut' => $this->integer()->notNull(),
			'idArInto' => $this->integer()->notNull(),
			'quantity' => $this->integer()->notNull(),
			'note' => $this->string(255),
		], $default), $tableOptions);

	}

	public function down()
	{
		$this->dropTable('{{%user}}');
	}
}
