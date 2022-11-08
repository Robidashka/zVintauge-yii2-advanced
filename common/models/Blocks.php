<?php

namespace common\models;

use Yii;

class Blocks extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'blocks';
    }

    public function rules()
    {
        return [
            [['index', 'title'], 'string'],
            [['content'], 'string', 'max' => 1024],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'index' => 'Индекс',
            'title' => 'Заголовок',
            'content' => 'Описание',
        ];
    }

    public function getIndexedBlockArray() 
    {
        return $this->find()->where(['page_id' => $this->page_id])->asArray()->indexBy('index')->all();
    }
}