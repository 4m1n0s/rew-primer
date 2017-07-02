<?php

use yii\db\Migration;

/**
 * Handles the creation of table `redeem`.
 */
class m170629_135721_create_redeem_table extends Migration
{
    public $tableName = '{{%redeem_limit}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(),
            'amount' => $this->decimal(12, 5)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idx_user_id_created_at', $this->tableName, ['user_id', 'created_at']);
        $this->addForeignKey(
            'fk_redeem_limit_users_user_id',
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
