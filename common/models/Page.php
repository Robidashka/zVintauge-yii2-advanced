<?php

namespace common\models;

use Yii;
use dvizh\seo\models\Seo;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string|null $page_name
 * @property string|null $key
 *
 * @property Blocks[] $blocks
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            'seo' => [
                'class' => 'dvizh\seo\behaviors\SeoFields',
            ],

            'files' => [
                'class' => 'floor12\files\components\FileBehaviour',
                'attributes' => [
                    'slider',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_name', 'key'], 'string', 'max' => 255],
            [['slider'], 'required'],
            [['slider'], 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxFiles' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_name' => 'Название страницы',
            'key' => 'Ключ',
            'slider' => 'Слайдер',
        ];
    }

    /**
     * Gets query for [[Blocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Blocks::class, ['page_id' => 'id']);
    }

    public function getIndexedBlockArray() 
    {
        return Block::find()->where(['page_id' => $this->id])->asArray()->indexBy('index')->all();
    }
}
