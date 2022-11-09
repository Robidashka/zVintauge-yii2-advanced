<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m221108_120120_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'page_name'=>$this->string(),
            'key'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
