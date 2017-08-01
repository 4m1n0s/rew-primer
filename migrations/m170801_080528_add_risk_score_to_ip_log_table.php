<?php

use yii\db\Migration;

class m170801_080528_add_risk_score_to_ip_log_table extends Migration
{
    public $tableName = '{{%user_ip_log}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'risk_score', $this->decimal(4, 2)->defaultValue(0)->unsigned());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'risk_score');
    }
}
