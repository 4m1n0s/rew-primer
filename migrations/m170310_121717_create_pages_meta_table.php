<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `pages_meta`.
 */
class m170310_121717_create_pages_meta_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%pages_meta}}', [
            'id' => 'pk',
            'id_page' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'meta_key' => Schema::TYPE_STRING . '(255) NOT NULL',
            'meta_value' => Schema::TYPE_TEXT . ' NOT NUll'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%pages_meta}}');
    }
}
