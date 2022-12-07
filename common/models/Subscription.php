<?php

namespace common\models;

use Yii;

class Subscription extends \yii\db\ActiveRecord
{
    public $agree = true;

    public static function tableName()
    {
        return '{{%subscription}}';
    }

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['agree'], 'boolean'],
            [['subs_time','email'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'subs_time' => 'Subscription time',
        ];
    }
}