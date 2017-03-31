<?php

use yii\db\Migration;
use app\modules\user\models\User;
use yii\db\Schema;

class m170329_111049_add_column_in_users_table extends Migration
{
    public function up()
    {
        $this->addColumn(User::tableName(), 'gender', 'TINYINT(1) NULL');
        $this->addColumn(User::tableName(), 'birthday', Schema::TYPE_DATE . ' NULL');
    }

    public function down()
    {
        $this->dropColumn(User::tableName(), 'birthday');
        $this->dropColumn(User::tableName(), 'gender');
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
