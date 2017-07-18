<?php

use yii\db\Migration;

class m170717_135356_create_seo_content_table extends Migration
{
    public function up()
    {
        $this->createTable('{{seo_content}}', [
            'id' => $this->primaryKey(),
            'model_name' => $this->string(255)->notNull(),
            'model_id' =>  $this->string(255)->notNull(),
            'title' => $this->string(255),
            'keywords' => $this->string(512),
            'description' => $this->string(1024)
        ]);

        $this->createIndex('seo_content_model_model_id', '{{seo_content}}', ['model_name', 'model_id'], true);
    }

    public function down()
    {
        $this->dropTable('{{seo_content}}');
    }
}
