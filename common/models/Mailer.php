<?php

namespace common\models;

use Yii;

class Mailer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mailer';
    }

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'string', 'max' => 255]
        ];
    }
}