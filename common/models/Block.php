<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blocks".
 *
 * @property int $id
 * @property string|null $index
 * @property string|null $title
 * @property string|null $content
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'number'],
            [['index', 'title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'ID страниы',
            'index' => 'Index',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }
}
