<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_social`.
 */
class m170518_090731_create_auth_social_table extends Migration
{
    public $tableName = '{{%auth_social}}';

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
            'client_id' => 'TINYINT UNSIGNED NOT NULL',
            'external_id' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('idx_auth_social', $this->tableName, ['client_id', 'external_id']);
        $this->addForeignKey(
            'fk_auth_social_users_user_id',
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
