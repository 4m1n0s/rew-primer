<?php

use yii\db\Migration;
use yii\db\Schema;
use app\modules\user\models\Token;

class m170728_113519_update_token_table extends Migration
{
    public function up()
    {
        $this->alterColumn(Token::tableName(), 'ip', Schema::TYPE_STRING . '(45) NOT NULL');
    }

    public function down()
    {
        $this->alterColumn(Token::tableName(), 'ip', Schema::TYPE_STRING . '(32) NOT NULL');
    }
}
