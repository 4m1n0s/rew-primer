<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ref_order_product`.
 */
class m170706_093535_create_ref_product_order_table extends Migration
{
    public $tableName = '{{%ref_product_order}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'order_id' => $this->integer()->unsigned()->notNull(),
            'product_id' => $this->integer()->unsigned()->notNull(),
            'quantity' => $this->smallInteger()->unsigned()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['order_id', 'product_id']);

        $this->addForeignKey(
            'fk_ref_order_product_order_order_id',
            $this->tableName,
            'order_id',
            '{{%order}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_ref_order_product_product_product_id',
            $this->tableName,
            'product_id',
            '{{%product}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
