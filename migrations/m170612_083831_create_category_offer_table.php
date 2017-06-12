<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_offer`.
 */
class m170612_083831_create_category_offer_table extends Migration
{
    public $tableName = '{{%category_offer}}';

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
            'category_id' => $this->integer(),
            'offer_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_category',
            $this->tableName,
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_offer',
            $this->tableName,
            'offer_id',
            '{{%offer}}',
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
