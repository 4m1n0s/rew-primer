<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_group`.
 */
class m170424_075914_create_user_group_table extends Migration
{
    public $tableName = '{{%user_group}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'type' => 'TINYINT UNSIGNED NOT NULL DEFAULT 0',
            'name' => $this->string(),
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
