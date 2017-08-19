<?php

use yii\db\Migration;

class m170816_125805_alter_product_table extends Migration
{
    public $tableName = '{{%product}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'type', $this->boolean()->unsigned());
        $this->addColumn($this->tableName, 'vendor', $this->boolean()->unsigned());
        $this->dropIndex('sku', $this->tableName);
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'type');
        $this->dropColumn($this->tableName, 'vendor');
        $this->createIndex('sku', $this->tableName, 'sku', true);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
