<?php

use yii\db\Migration;
use yii\db\Schema;

class m170507_115112_modify_ar extends Migration
{
    public function safeUp()
    {
        // $this->addColumn('{{%ar}}', 'isTransfer', $this->smallInteger(1)->notNull()->defaultValue(0));
        $this->addColumn('{{%transfer}}', 'date', Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP');
    }

    public function safeDown()
    {
        echo "m170507_115112_modify_ar_isTransfer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170507_115112_modify_ar_isTransfer cannot be reverted.\n";

        return false;
    }
    */
}
