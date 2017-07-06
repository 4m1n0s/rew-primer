<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170706_092648_create_order_table extends Migration
{
    public $tableName = '{{%order}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->boolean()->unsigned()->notNull()->defaultValue(1)->comment('PROCESSING = 1, COMPLETED = 2, CANCELLED = 3'),
            'note' => $this->text(),
            'closed_user_id' => $this->integer(),
            'closed_date' => $this->integer(),
            'create_date' => $this->integer()->notNull(),
            'update_date' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_order_users_user_id',
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
