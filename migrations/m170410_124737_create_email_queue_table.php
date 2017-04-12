<?php

use yii\db\Migration;

/**
 * Handles the creation of table `email_queue`.
 */
class m170410_124737_create_email_queue_table extends Migration
{
    public $tableName = '{{%email_queue}}';

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
            'template_id'   => $this->integer()->unsigned(),
            'sender'        => $this->string(150)->notNull(),
            'recipient'     => $this->string(150)->notNull(),
            'create_date'   => $this->dateTime()->notNull(),
            'send_date'     => $this->dateTime(),
            'status'        => 'TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT \' "PROCESSING" = 0, "SENT" = 1 , "REJECTED" = 2 \'',
            'params'        => $this->text(),
            'note'          => $this->text(),
        ], $tableOptions);

        $this->addForeignKey(
            'template_template_id_fk',
            $this->tableName,
            'template_id',
            '{{%email_template}}',
            'id',
            'RESTRICT',
            'RESTRICT'
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
