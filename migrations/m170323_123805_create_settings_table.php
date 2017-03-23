<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `settings`.
 */
class m170323_123805_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'meta_key' => Schema::TYPE_STRING . '(255) NOT NULL',
            'meta_value' => Schema::TYPE_TEXT . ' NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
