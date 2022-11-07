<?php

use yii\db\Migration;

class m221107_112708_create_main_pages_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%main_pages_seo}}', [
            'id' => $this->primaryKey(),
            'h1_home' => $this->string(),
            'keywords_home' => $this->string(255),
            'description_home' => $this->string(522),
            'text_home' => $this->string(),
            'h1_about' => $this->string(),
            'keywords_about' => $this->string(255),
            'description_about' => $this->string(522),
            'text_about' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%main_pages_seo}}');
    }
}
