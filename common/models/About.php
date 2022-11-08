<?php

namespace common\models;

use Yii;

class About extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'about';
    }

    public function behaviors()
    {
        return [
            'files' => [
                'class' => 'floor12\files\components\FileBehaviour',
                'attributes' => [
                    'slider',
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'string'],
            [['description'], 'string', 'max' => 1024],
            [['text'], 'string', 'max' => 2048],
            [['slider'], 'required'],
            [['slider'], 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxFiles' => 5]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider' => 'Слайдер',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'text' => 'Текст',
        ];
    }
}