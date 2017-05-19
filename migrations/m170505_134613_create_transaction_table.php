<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170505_134613_create_transaction_table extends Migration
{
    public $tableName = '{{%transaction}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        }

        $this->createTable($this->tableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'type'          => 'TINYINT UNSIGNED NOT NULL COMMENT \' ‘OFFER_INCOME’ = 1, ‘REFERRAL_INCOME’ = 2, ‘REDEMPTION_SPEND’ = 3 \'',
            'status'        => 'TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT \' ‘PENDING’ = 1, ‘COMPLETE’ = 2, ‘REJECTED’ = 3, ‘DELETED’ = 4 \'',
            'amount'        => $this->decimal(10, 2),
            'user_id'       => $this->integer(11)->notNull(),
            'ip'            => $this->string(45),
            'object_type'   => 'TINYINT UNSIGNED NOT NULL COMMENT \' ‘REFERRAL’ = 1 \'',
            'object_id'     => $this->integer(11)->notNull()->comment('For example object_type = 1(REFERRAL) it is user ID'),
            'description'   => $this->string()->notNull(),
            'params'        => $this->text(),
            'created_at'    => $this->integer(11)->unsigned()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_transaction_users_user_id',
            $this->tableName,
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
