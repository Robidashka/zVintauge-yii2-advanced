<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\ContactForm;
use yii\data\Pagination;
use common\models\Article;
use common\models\Category;
use yii\helpers\ArrayHelper;
use frontend\models\CommentForm;
use yii\data\ActiveDataProvider;


class BlogController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionBlog()
    {
        $query = Article::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>2]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('blog', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    public function actionCategory($id)
    {
        $query = Article::find()->where(['category_id'=>$id]);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>2]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('category', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    public function actionSearch()
    {
        $search = trim(Yii::$app->request->get('search'));

        $query = Article::find()->where(['like', 'title', $search]);
        
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>2]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if(!$search)
            return $this->render('search', [
                'pagination' => $pagination,
            ]);

        return $this->render('search', [
            'articles' => $articles,
            'pagination' => $pagination,
            'search' => $search,
        ]);
    }
    
}