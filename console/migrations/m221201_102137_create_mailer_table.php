<?php

use yii\db\Migration;

class m221201_102137_create_mailer_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%mailer}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'subscriber_id' => $this->integer()->notNull(),
            'end' => $this->boolean()->defaultValue(0),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mailer}}');
    }
}
