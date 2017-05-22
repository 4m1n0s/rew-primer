<?php

use yii\db\Migration;

class m170519_174205_update_user_table extends Migration
{
    public $tableName = '{{%users}}';

    public function up()
    {
        $this->alterColumn($this->tableName, 'username', $this->string(60));
        $this->alterColumn($this->tableName, 'email', $this->string(100));
        $this->dropIndex('email_unique', $this->tableName);
    }

    public function down()
    {
        $this->alterColumn($this->tableName, 'username', $this->string(60)->notNull());
        $this->alterColumn($this->tableName, 'email', $this->string(100)->notNull());
    }
}
