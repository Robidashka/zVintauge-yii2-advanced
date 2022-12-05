<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mailer}}`.
 */
class m221201_102137_create_mailer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mailer}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'subscriber_id' => $this->integer()->notNull(),
            'end' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mailer}}');
    }
}
