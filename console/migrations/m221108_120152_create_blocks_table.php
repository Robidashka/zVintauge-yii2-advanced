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
            'page_id' => $this->integer(),
            'index' => $this->string(),
            'title' => $this->string(),
            'content' => $this->string(1024),
        ]);

        $this->createIndex(
            'idx-page_id',
            'blocks',
            'page_id',
        );

        $this->addForeignKey(
            'fk-page_id',
            'blocks',
            'page_id',
            'page',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-page_id',
            'page',
        );

        $this->dropIndex(
            'idx-page_id',
            'page',
        );

        $this->dropTable('{{%blocks}}');
    }
}
