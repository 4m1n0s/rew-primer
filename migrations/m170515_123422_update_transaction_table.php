<?php

use yii\db\Migration;

class m170515_123422_update_transaction_table extends Migration
{
    public $tableName = '{{%transaction}}';

    public function up()
    {
        $this->alterColumn($this->tableName, 'object_id', $this->string(64)->comment('For example object_type = 1(REFERRAL) it is user ID'));
    }

    public function down()
    {
        $this->alterColumn($this->tableName, 'object_id', $this->integer(11)->notNull()->comment('For example object_type = 1(REFERRAL) it is user ID'));
    }
}
