<?php

use yii\db\Migration;

class m170717_092301_create_page_table extends Migration
{
    public $tableName = '{{%page}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'template' => $this->boolean()->unsigned()->notNull()->unique(),
            'title' => $this->string(),
            'description' => $this->text(),
            'content' => $this->text(),
            'created_at' => $this->integer()->unsigned()->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
