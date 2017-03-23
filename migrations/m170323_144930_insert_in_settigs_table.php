<?php

use yii\db\Migration;
use app\modules\settings\forms\SettingForm;
use app\modules\settings\models\Settings;

class m170323_144930_insert_in_settigs_table extends Migration
{
    public function up()
    {
        $attr = new SettingForm();
        foreach ($attr->attributes() as $key => $value) {
            $this->insert(Settings::tableName(), [
                'meta_key' => $value
            ]);
        }
    }

    public function down()
    {
        $model = Settings::deleteAll();
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
