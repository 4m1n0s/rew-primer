<?php

use yii\db\Migration;

class m170719_140433_create_table_offer_device_type_table extends Migration
{
    public $tableName = '{{%offer_device_type}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'offer_id'  => $this->integer()->notNull(),
            'type'      => $this->smallInteger()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['offer_id', 'type']);

        $this->addForeignKey(
            'fk_offer_device_type_offer_offer_id',
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
