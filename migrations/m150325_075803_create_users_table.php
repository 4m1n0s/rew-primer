<?php

use yii\db\Schema;
use yii\db\Migration;

class m150325_075803_create_users_table extends Migration {

    public function up() {
        $security = new yii\base\Security();
        $this->createTable('{{%users}}', [
            'id' => 'pk',
            'username' => Schema::TYPE_STRING . '(60) NOT NULL',
            'email' => Schema::TYPE_STRING . '(100) NOT NULL',
            'role' => 'TINYINT(1) NOT NULL',
            'password' => Schema::TYPE_STRING . '(64) NOT NULL',
            'referral_code' => Schema::TYPE_STRING . '(12) NOT NULL',
            'create_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL'
        ]);

        $this->insert('{{%users}}', [
            'username' => 'admin',
            'email' => 'sf_admin@gmail.com',
            'role' => \app\modules\user\models\User::ROLE_ADMIN,
            'password' => \app\modules\user\helpers\Password::hash('SfPass123'),
            'referral_code' => $security->generateRandomString(12),
            'create_date' => gmdate("Y-m-d H:i:s", time()),
            'status' => \app\modules\user\models\User::STATUS_APPROVED
        ]);
        
        $this->insert('{{%users}}', [
            'username' => 'sf_user',
            'email' => 'sf_user@gmail.com',
            'role' => \app\modules\user\models\User::ROLE_USER,
            'password' => \app\modules\user\helpers\Password::hash('pass123123'),
            'referral_code' => $security->generateRandomString(12),
            'create_date' => gmdate("Y-m-d H:i:s", time()),
            'status' => \app\modules\user\models\User::STATUS_APPROVED
        ]);

        $this->createIndex('referral_code_unique', '{{%users}}', ['referral_code'], true);
        $this->createIndex('username_unique', '{{%users}}', ['username'], true);
        $this->createIndex('email_unique', '{{%users}}', ['email'], true);
    }

    public function down() {
        $this->dropTable('{{%users}}');
    }

}
