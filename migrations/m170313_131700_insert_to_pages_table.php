<?php

use yii\db\Migration;
use app\modules\pages\models\Pages;

class m170313_131700_insert_to_pages_table extends Migration
{
    public function up()
    {
        foreach (Pages::getConstPage() as $item) {
            $this->insert('{{%pages}}', [
                'name' => $item['name']
            ]);
        }
    }

    public function down()
    {
        $this->truncateTable('{{%pages}}');
    }
}
