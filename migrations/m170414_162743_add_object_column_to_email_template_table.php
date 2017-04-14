<?php

use yii\db\Migration;

/**
 * Handles adding object to table `email_template`.
 */
class m170414_162743_add_object_column_to_email_template_table extends Migration
{
    public $tableName = '{{%email_template}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'subject', $this->string(64));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'subject');
    }
}
