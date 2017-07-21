<?php

use yii\db\Migration;

class m170719_115715_create_ref_transaction_offer_table extends Migration
{
    public $tableName = '{{%ref_transaction_offer}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'transaction_id' => $this->integer()->notNull()->unsigned(),
            'offer_id' => $this->integer()->notNull(),
            'lead_id' => $this->string(64),
            'campaign_id' => $this->string(64),
            'campaign_name' => $this->string(128)
        ], $tableOptions);

        $this->addForeignKey(
            'fk_ref_transaction_offer_transaction_transaction_id',
            $this->tableName,
            'transaction_id',
            '{{%transaction}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_ref_transaction_offer_offer_offer_id',
            $this->tableName,
            'offer_id',
            '{{%offer}}',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
