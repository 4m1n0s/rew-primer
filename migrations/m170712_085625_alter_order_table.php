<?php

use yii\db\Migration;

class m170712_085625_alter_order_table extends Migration
{
    public $tableName = '{{%order}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'refunded', $this->boolean()->notNull()->unsigned()->defaultValue(0));
        $this->addColumn($this->tableName, 'cost', $this->decimal(10, 2)->notNull());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'refunded');
        $this->dropColumn($this->tableName, 'cost');
    }
}
