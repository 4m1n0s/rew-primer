<?php

use yii\db\Migration;

class m170823_113042_add_fk_to_log_postback_table extends Migration
{
    public $tableName = '{{%log_postback}}';

    public function up()
    {
        $this->alterColumn($this->tableName, 'offer_id', $this->integer());
        $this->addForeignKey(
            'log_postback_offer_offer_id',
            $this->tableName,
            'offer_id',
            '{{%offer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('log_postback_offer_offer_id', $this->tableName);
        $this->alterColumn($this->tableName, 'offer_id', $this->boolean()->unsigned());
    }
}
