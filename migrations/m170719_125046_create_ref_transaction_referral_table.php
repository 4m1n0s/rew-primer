<?php

use yii\db\Migration;

class m170719_125046_create_ref_transaction_referral_table extends Migration
{
    public $tableName = '{{%ref_transaction_referral}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'transaction_id' => $this->integer()->notNull()->unsigned(),
            'user_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk_ref_transaction_referral_transaction_transaction_id',
            $this->tableName,
            'transaction_id',
            '{{%transaction}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_ref_transaction_referral_users_user_id',
            $this->tableName,
            'user_id',
            '{{%users}}',
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
