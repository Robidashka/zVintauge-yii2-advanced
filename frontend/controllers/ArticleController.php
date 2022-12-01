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
use common\models\Mailer;
use common\models\Category;
use yii\helpers\ArrayHelper;
use frontend\models\CommentForm;
use yii\data\ActiveDataProvider;


class ArticleController extends Controller
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

    public function actionIndex()
    {
        $query = Article::getArticlesPosted();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>2]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($slug) {
        $article = Article::find()->where(['slug'=>$slug])->one();
        $comments = $article->getArticleComments();
        $model = new CommentForm();
        $article -> viewedCount();
        $mailer = new Mailer();

        return $this->render('view', [
            'article' => $article,
            'comments' => $comments,
            'model' => $model,
            'mailer' => $mailer
        ]);
    }

    public function actionSearch($search, $submit)
    {
        $query = Article::getArticlesPosted(['like', 'title', $search]);
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

    public function actionComment($id, $slug)
    {
        $model = new CommentForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post()) && $model->saveComment($id)) {
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'message' => 'Model has been saved.',
                    ],
                    'code' => 0,
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'model' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
        }
    }

    public function actionMailer($slug)
    {
        $mailer = new Mailer();
        if ($mailer->load(Yii::$app->request->post()) && $mailer->save()) {
            return $this->redirect(['/article/view', 'slug' => $slug]);
        }
        return $this->redirect(['/article/view', 'slug' => $slug]);
    }
}