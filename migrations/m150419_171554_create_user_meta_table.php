<?php

use yii\db\Schema;
use yii\db\Migration;

class m150419_171554_create_user_meta_table extends Migration {

    public function up() {
        if (null === Yii::$app->db->getSchema()->getTableSchema('{{%user_meta}}')) {
            $this->createTable('{{%user_meta}}', [
                'id'                => 'pk',
                'user_id'           => Schema::TYPE_INTEGER . '(11) NULL',
                'meta_key'          => Schema::TYPE_STRING . '(255) NOT NULL',
                'meta_value'        => Schema::TYPE_TEXT . ' NOT NULL',
            ]);
            // Add user foreign key
            $this->addForeignKey('fk_user_meta', '{{%user_meta}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
            
            // Add indexes
            $this->createIndex('inx_meta_key', '{{%user_meta}}', 'meta_key');
            $this->createIndex('inx_user_meta_key', '{{%user_meta}}', ['user_id', 'meta_key']);
        }
    }

    public function down() {
        if (null !== Yii::$app->db->getSchema()->getTableSchema('{{%user_meta}}')) {
            $this->dropTable('{{%user_meta}}');
        }
    }

}
