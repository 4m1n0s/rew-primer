<?php

use yii\db\Migration;

class m170719_140441_create_table_offer_device_os_table extends Migration
{
    public $tableName = '{{%offer_device_os}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'offer_id'  => $this->integer()->notNull(),
            'os'        => $this->smallInteger()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['offer_id', 'os']);

        $this->addForeignKey(
            'fk_offer_device_os_offer_offer_id',
            $this->tableName,
            'offer_id',
            '{{%offer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
