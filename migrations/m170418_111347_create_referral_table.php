<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referral`.
 */
class m170418_111347_create_referral_table extends Migration
{
    public $tableName = '{{%referral}}';

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
            'source_user_id' => $this->integer(11)->notNull(),
            'target_user_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_source_user_id', $this->tableName, 'source_user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_target_user_id', $this->tableName, 'target_user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addPrimaryKey('pk', $this->tableName, ['source_user_id', 'target_user_id']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
