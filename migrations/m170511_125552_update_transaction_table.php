<?php

use yii\db\Migration;

class m170511_125552_update_transaction_table extends Migration
{
    public $tableName = '{{%transaction}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'name', $this->string(128));
        $this->addColumn($this->tableName, 'external_transaction_id', $this->string(64));
        $this->alterColumn($this->tableName, 'description', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'name');
        $this->dropColumn($this->tableName, 'external_transaction_id');
        $this->alterColumn($this->tableName, 'description', $this->string()->notNull());
    }
}
