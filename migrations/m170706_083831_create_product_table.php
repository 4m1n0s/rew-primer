<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170706_083831_create_product_table extends Migration
{
    public $tableName = '{{%product}}';

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
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'sku' => $this->string(32)->notNull()->unique(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull(),
            'status' => $this->boolean()->unsigned()->notNull()->defaultValue(1)->comment('IN STOCK = 1, OUT OF STOCK = 2'),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
