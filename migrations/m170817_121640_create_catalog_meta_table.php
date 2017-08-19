<?php

use yii\db\Migration;

class m170817_121640_create_catalog_meta_table extends Migration
{
    public $tableName = '{{%catalog_meta}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'type' => $this->boolean()->unsigned()->notNull(),
            'entity' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->text()
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['type', 'entity', 'key']);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
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
