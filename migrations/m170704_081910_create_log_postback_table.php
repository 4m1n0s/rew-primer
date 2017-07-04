<?php

use yii\db\Migration;

class m170704_081910_create_log_postback_table extends Migration
{
    public $tableName = '{{%log_postback}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'offer_id' => $this->boolean()->unsigned(),
            'prefix' => $this->text(),
            'message' => $this->text(),
            'log_vars' => $this->text(),
            'log_time' => $this->double(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
