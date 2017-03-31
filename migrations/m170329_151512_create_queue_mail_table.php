<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `queue_mail`.
 */
class m170329_151512_create_queue_mail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%queue_mail}}', [
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'mail_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => 'TINYINT(1) NOT NULL'
        ]);

        $this->addForeignKey('fk_user_mail', '{{%queue_mail}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_mail', '{{%queue_mail}}');
        $this->dropTable('{{%queue_mail}}');
    }
}
