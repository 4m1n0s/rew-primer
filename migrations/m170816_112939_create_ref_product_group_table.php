<?php

use yii\db\Migration;

class m170816_112939_create_ref_product_group_table extends Migration
{
    public $tableName = '{{%ref_product_group}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'product_id' => $this->integer()->unsigned(),
            'group_id' => $this->integer()->unsigned()
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['product_id', 'group_id']);

        $this->addForeignKey(
            'fk_ref_product_group_product_product_id',
            $this->tableName,
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_ref_product_group_product_group_group_id',
            $this->tableName,
            'group_id',
            '{{%product_group}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
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
