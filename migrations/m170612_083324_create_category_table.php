<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170612_083324_create_category_table extends Migration
{
    public $tableName = '{{%category}}';

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
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue(0),
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
