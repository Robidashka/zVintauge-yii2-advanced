<?php

namespace common\models;

use Yii;

class Mailer extends \yii\db\ActiveRecord
{
    public $agree = true;

    public static function tableName()
    {
        return 'mailer';
    }

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'unique'],
            ['agree', 'boolean'],
            [['email'], 'string', 'max' => 255]
        ];
    }
}