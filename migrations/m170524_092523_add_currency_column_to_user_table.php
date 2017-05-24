<?php

use yii\db\Migration;

/**
 * Handles adding currency to table `user`.
 */
class m170524_092523_add_currency_column_to_user_table extends Migration
{
    public $tableName = '{{%users}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'virtual_currency', $this->decimal(12, 5)->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'virtual_currency');
    }
}
