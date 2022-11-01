<?php

namespace common\models;

use Yii;
use yii\data\Pagination;
use common\models\ImageUpload;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use dvizh\seo\models\Seo;

class Article extends \yii\db\ActiveRecord
{
    const ARTICLE_DRAFT = 0;
    const ARTICLE_POSTED = 1;
    const ARTICLE_ARCHIVED = 2;

    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],

            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

            'seo' => [
                'class' => 'dvizh\seo\behaviors\SeoFields',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','description','content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'number'],
            [['status'], 'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'description' => 'Описание',
            'content' => 'Содержание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'image' => 'Изображение',
            'viewed' => 'Просмотры',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'category_id' => 'Категория',
        ];
    }

    public static function getArticleStatusesLabel() {
        return [
            self::ARTICLE_DRAFT => 'Черновик',
            self::ARTICLE_POSTED => 'Опубликовано',
            self::ARTICLE_ARCHIVED => 'В архиве',
        ];
    }

    public function getArticleStatusLabel() {
        return self::getArticleStatusesLabel()[$this->status];
    }

    public function archived()
    {
        $this->status = self::ARTICLE_ARCHIVED;
        return $this->save(false);
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        return ($this->image) ?  '/backend/web/uploads/' . $this->image : '/backend/web/uploads/no-image.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);
        if($category != null)
        {
            $this->link('category', $category);
            return true;            
        }
    }
    
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }
    
    public static function getAll($pageSize = 5)
    {
        $query = Article::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        
        return $data;
    }
    
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id'=>'id']);
    }

    public function getArticleComments()
    {
        $commentStatus = [
            self::ARTICLE_DRAFT, 
            self::ARTICLE_POSTED,
        ];
        return $this->getComments()->where(['status'=>$commentStatus])->all();
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    
    public function viewedCount()
    {
        $this->viewed += 1;
        return $this->save(false);
    }
}