<?php

use yii\db\Schema;
use yii\db\Migration;

class m150718_130029_base_subscriber extends Migration {
    public function up() {
        $this->createTable('{{%subscribers}}', [
            'id'            => 'pk',
            'email'         => Schema::TYPE_STRING . '(100) NOT NULL',
            'frequency'     => Schema::TYPE_INTEGER . "(1) DEFAULT 0",
            'status'        => Schema::TYPE_INTEGER . "(1) DEFAULT 1",
            'create_date'   => Schema::TYPE_DATETIME . ' NOT NULL'
        ]);
        
        $this->createIndex('inx_email', '{{%subscribers}}', 'email');
        $this->createIndex('inx_status', '{{%subscribers}}', 'status');
    }

    public function down() {
        $this->dropTable('{{%subscribers}}');
    }

}
