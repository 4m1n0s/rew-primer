<?php

use yii\db\Migration;

/**
 * Handles the creation of table `foreign_key_for_pages_meta`.
 */
class m170310_153734_create_foreign_key_for_pages_meta_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addForeignKey('fk_page_meta', '{{%pages_meta}}', 'id_page', '{{%pages}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_page_meta', '{{%pages_meta}}');
    }
}
