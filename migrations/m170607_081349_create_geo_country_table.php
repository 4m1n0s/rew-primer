<?php

use yii\db\Migration;

/**
 * Handles the creation of table `geo_country`.
 */
class m170607_081349_create_geo_country_table extends Migration
{
    public $tableName = '{{%geo_country}}';

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
            'id' => $this->primaryKey(),
            'geoname_id' => $this->integer()->unsigned()->notNull(),
            'locale_code' => $this->char(2)->notNull(),
            'continent_code' => $this->char(2)->notNull(),
            'continent_name' => $this->string(64)->notNull(),
            'country_iso_code' => $this->char(2)->notNull(),
            'country_name' => $this->string(64)->notNull()
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
