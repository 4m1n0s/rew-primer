<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m170420_093320_create_contact_table extends Migration
{
    public $tableName = '{{%contact}}';

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
            'id' => $this->primaryKey()->unsigned(),
            'status' => 'TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT \' "NEW" = 1, "READ" = 2 , "ANSWERED" = 3 \'',
            'name' => $this->string(64)->notNull(),
            'email' => $this->string(100)->notNull(),
            'subject' => $this->string()->notNull(),
            'message' => $this->text(),
            'create_date' => $this->dateTime()->notNull(),
            'update_date' => $this->dateTime()->notNull()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
