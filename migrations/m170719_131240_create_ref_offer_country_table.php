<?php

use yii\db\Migration;

class m170719_131240_create_ref_offer_country_table extends Migration
{
    public $tableName = '{{%ref_offer_country}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'offer_id' => $this->integer()->notNull(),
            'country_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk', $this->tableName, ['offer_id', 'country_id']);

        $this->addForeignKey(
            'fk_ref_offer_country_offer_offer_id',
            $this->tableName,
            'offer_id',
            '{{%offer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_ref_offer_country_country_country_id',
            $this->tableName,
            'country_id',
            '{{%geo_country}}',
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
