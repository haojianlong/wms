<?php

use yii\db\Migration;

class m170505_093429_modify_product_quantity extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'quantity', $this->integer(11)->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m170505_093429_modify_prpduct_quantiy cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170505_093429_modify_prpduct_quantiy cannot be reverted.\n";

        return false;
    }
    */
}
