<?php

use yii\db\Migration;

class m170410_114157_remove_old_queue_mail_table extends Migration
{
    public function up()
    {
        $this->dropTable('{{%queue_mail}}');
    }

    public function down()
    {
        echo "m170410_114157_remove_old_queue_mail_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
