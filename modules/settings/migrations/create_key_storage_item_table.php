<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class create_key_storage_item_table extends Migration
{
    protected $tableName = '{{%key_storage_item}}';

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
            'key' => $this->string(128)->notNull(),
            'value' => $this->text(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_key_storage_item_key', $this->tableName, 'key');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
