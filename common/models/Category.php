<?php

namespace common\models;

use Yii;
use yii\data\Pagination;
use yii\behaviors\SluggableBehavior;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Название',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
    

    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }
    
    public static function getAll()
    {
        return Category::find()->all();
    }


    
    public function getArticlesByCategory()
    {
        $query = Article::find()->where(['category_id'=>$this->id])->andWhere(['status'=>1])->orderBy('updated_at desc');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>2]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        
        return $data;
    }
}