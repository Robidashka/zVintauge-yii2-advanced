<?php

use yii\db\Migration;

class m221201_102112_create_subscription_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'subs_time' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subscription}}');
    }
}
