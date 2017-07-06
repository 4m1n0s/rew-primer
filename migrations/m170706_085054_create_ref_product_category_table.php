<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ref_category_product`.
 */
class m170706_085054_create_ref_product_category_table extends Migration
{
    public $tableName = '{{%ref_product_category}}';

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
            'category_id' => $this->integer()->unsigned()->notNull(),
            'product_id' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARY', $this->tableName, ['category_id', 'product_id']);

        $this->addForeignKey(
            'fk_ref_category_product_category_product_category_id',
            $this->tableName,
            'category_id',
            '{{%category_product}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_ref_category_product_product_product_id',
            $this->tableName,
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE',
            'CASCADE'
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
