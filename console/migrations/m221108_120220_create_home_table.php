<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%home}}`.
 */
class m221108_120220_create_home_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%home}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%home}}');
    }
}
