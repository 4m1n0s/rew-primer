<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `pages`.
 */
class m170310_152829_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%pages}}', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL'
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
