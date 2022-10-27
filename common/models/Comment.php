<?php

namespace common\models;

use Yii;

class Comment extends \yii\db\ActiveRecord
{
    const COMMENT_DRAFT = 0;
    const COMMENT_ALLOWED = 1;
    const COMMENT_ARCHIVED = 2;

    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'user_id' => 'Пользователь',
            'article_id' => 'Статья',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }

    public static function getStatusesLabel() {
        return [
            self::COMMENT_DRAFT => 'На рассмотрении',
            self::COMMENT_ALLOWED => 'Разрешен',
            self::COMMENT_ARCHIVED => 'В архиве',
        ];
    }

    public static function getUserLabel() {
        //return $this->hasOne(User::className(), ['id' => 'user_id']); ???
    }

    public static function getArticleTitle() {
    }

    public function getStatusLabel() {
        return self::getStatusesLabel()[$this->status];
    }

    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public function archived()
    {
        $this->status = self::COMMENT_ARCHIVED;
        return $this->save(false);
    }

    public function allow()
    {
        $this->status = self::COMMENT_ALLOWED;
        return $this->save(false);
    }
}