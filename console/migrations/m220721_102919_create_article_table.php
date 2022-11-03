<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m220721_102919_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'content'=>$this->text(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'viewed'=>$this->integer(),
            'user_id'=>$this->integer(),
            'status'=>$this->integer(),
            'category_id'=>$this->integer(),
        ]);
        
        $this->createIndex(
            'idx-category_id',
            'article',
            'category_id',
        );

        $this->addForeignKey(
            'fk-category_id',
            'article',
            'category_id',
            'category',
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
            'fk-category_id',
            'article',
        );

        $this->dropIndex(
            'idx-category_id',
            'article',
        );

        $this->dropTable('article');
    }
}
