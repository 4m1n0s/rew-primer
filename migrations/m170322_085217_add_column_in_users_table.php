<?php

use yii\db\Migration;
use app\modules\user\models\User;
use yii\db\Schema;

class m170322_085217_add_column_in_users_table extends Migration
{
    public function up()
    {
        $this->addColumn(User::tableName(), 'update_date', Schema::TYPE_DATETIME . ' NULL');
        $this->addColumn(User::tableName(), 'first_name', Schema::TYPE_STRING . '(255) NULL');
        $this->addColumn(User::tableName(), 'last_name', Schema::TYPE_STRING . '(255) NULL');
    }

    public function down()
    {
        $this->dropColumn(User::tableName(), 'last_name');
        $this->dropColumn(User::tableName(), 'first_name');
        $this->dropColumn(User::tableName(), 'update_date');
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
