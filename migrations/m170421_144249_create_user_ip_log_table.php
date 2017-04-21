<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_ip_log`.
 */
class m170421_144249_create_user_ip_log_table extends Migration
{
    public $tableName = '{{%user_ip_log}}';

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
            'id'        => $this->primaryKey()->unsigned(),
            'user_id'   => $this->integer()->notNull(),
            'ip'        => $this->string(45)->notNull()
        ], $tableOptions);

        $this->createIndex('idx_user_ip', $this->tableName, ['user_id', 'ip'], true);
        $this->addForeignKey(
            'fk_user_id_user',
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
