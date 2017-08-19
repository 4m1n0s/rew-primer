<?php

use yii\db\Migration;

class m170817_103844_create_ref_product_group_category_table extends Migration
{
    public $tableName = '{{%ref_product_group_category}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'category_id' => $this->integer()->unsigned()->notNull(),
            'group_id' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['group_id', 'category_id']);

        $this->addForeignKey(
            'ref_product_group_category_category_product_group_category_id',
            $this->tableName,
            'category_id',
            '{{%category_product_group}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'ref_product_group_category_product_group_group_id',
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
