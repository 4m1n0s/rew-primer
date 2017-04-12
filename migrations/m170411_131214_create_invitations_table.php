<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invitations`.
 */
class m170411_131214_create_invitations_table extends Migration
{
    public $tableName = '{{%invitations}}';
    
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
            'id' =>  $this->primaryKey()->unsigned(),
            'email' => $this->string(100)->notNull(),
            'code' => $this->string(12),
            'status' => 'TINYINT(1) UNSIGNED NOT NULL',
            'create_date' => $this->dateTime()->notNull(),
            'update_date' => $this->dateTime(),
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
