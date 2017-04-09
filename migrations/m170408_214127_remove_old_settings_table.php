<?php

use yii\db\Migration;

class m170408_214127_remove_old_settings_table extends Migration
{
    public function up()
    {
//        $this->dropTable('{{%settings}}');
    }

    public function down()
    {
        echo "m170408_214127_remove_old_settings_table cannot be reverted.\n";

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
