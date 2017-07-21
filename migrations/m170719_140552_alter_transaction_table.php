<?php

use yii\db\Migration;

class m170719_140552_alter_transaction_table extends Migration
{
    public $tableName = '{{%transaction}}';

    public function up()
    {
        $this->dropColumn($this->tableName, 'name');
        $this->dropColumn($this->tableName, 'external_transaction_id');
        $this->dropColumn($this->tableName, 'object_id');
        $this->dropColumn($this->tableName, 'object_type');
    }

    public function down()
    {
        $this->addColumn($this->tableName, 'name', $this->string(128));
        $this->addColumn($this->tableName, 'external_transaction_id', $this->string(64));
        $this->addColumn($this->tableName, 'object_id', $this->string(64)->comment('For example object_type = 1(REFERRAL) it is user ID'));
        $this->addColumn($this->tableName, 'object_type', 'TINYINT UNSIGNED NOT NULL COMMENT \' ‘REFERRAL’ = 1 \'');
    }
}
