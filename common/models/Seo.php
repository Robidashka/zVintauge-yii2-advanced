<?php

namespace common\models;

use Yii;

class Seo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'main_pages_seo';
    }

    public function rules()
    {
        return [
            [['text_home', 'text_about'], 'string'],
            [['h1_home', 'h1_about', 'keywords_home', 'keywords_about'], 'string', 'max' => 255],
            [['description_about', 'description_home'], 'string', 'max' => 522]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'h1_home' => 'H1',
            'keywords_home' => 'Ключевые слова',
            'description_home' => 'Описание',
            'text_home' => 'Текст',
            'h1_about' => 'H1',
            'keywords_about' => 'Ключевые слова',
            'description_about' => 'Описание',
            'text_about' => 'Текст',
        ];
    }
}