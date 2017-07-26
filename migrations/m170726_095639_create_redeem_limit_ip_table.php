<?php

use yii\db\Migration;

class m170726_095639_create_redeem_limit_ip_table extends Migration
{
    public $tableName = '{{%redeem_limit_ip}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'ip' => $this->string(45)->notNull(),
            'amount' => $this->decimal(12, 5)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_user_id_created_at', $this->tableName, ['ip', 'created_at']);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
