<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blocks}}`.
 */
class m221108_120152_create_blocks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blocks}}', [
            'id' => $this->primaryKey(),
            'index' => $this->string(),
            'title' => $this->string(),
            'content' => $this->string(1024),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blocks}}');
    }
}
