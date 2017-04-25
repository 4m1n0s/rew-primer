<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_group_relation`.
 */
class m170424_080716_create_user_group_relation_table extends Migration
{
    public $tableName = '{{%user_group_relation}}';

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
            'user_id' => $this->integer(),
            'group_id' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_user_group_relation', $this->tableName, ['user_id', 'group_id']);

        $this->addForeignKey(
            'fk_user_group_relation_users_user_id',
            $this->tableName,
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_group_relation_user_group_group_id',
            $this->tableName,
            'group_id',
            '{{%user_group}}',
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
