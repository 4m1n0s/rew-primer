<?php

use yii\db\Migration;

class m170615_085955_alter_offer_table extends Migration
{
    public $tableName = '{{%offer}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'label', $this->string(64)->notNull());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'label');
    }
}
