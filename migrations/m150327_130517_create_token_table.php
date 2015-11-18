<?php

use yii\db\Schema;
use yii\db\Migration;

class m150327_130517_create_token_table extends Migration {

    public function up() {
        $this->createTable('{{%token}}', [
            'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'code' => Schema::TYPE_STRING . '(32) NOT NULL',
            'create_date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL'
        ]);

        $this->createIndex('token_unique', '{{%token}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk_user_token', '{{%token}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down() {
        $this->dropTable('{{%token}}');
    }

}
