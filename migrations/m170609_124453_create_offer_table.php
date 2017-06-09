<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offer`.
 */
class m170609_124453_create_offer_table extends Migration
{
    public $tableName = '{{%offer}}';

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
            'id' => 'INT NOT NULL PRIMARY KEY',
            'active' => $this->boolean()->notNull()->defaultValue(0),
            'name' => $this->string(64)->notNull(),
            'img' => $this->string()->notNull(),
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
