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
use common\models\Subscription;
use common\models\Category;
use yii\helpers\Html;
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
        $subscription = new Subscription();

        return $this->render('view', [
            'article' => $article,
            'comments' => $comments,
            'model' => $model,
            'subscription' => $subscription,
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

    public function actionComment()
    {
        $model = new CommentForm();
        $post = Yii::$app->request->post();
        $id = $post['id'];

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $comment = $model->saveComment($id,$post['formComment']);
            
            if ($post && $comment) {
                Yii::$app->session->setFlash('success', "Your comment was send successfully.");

               return $this->renderAjax('_ajaxComment', [
                'comment'=>$comment
               ]);

            } else {
                Yii::$app->session->setFlash('error', "Something went wrong :(");
            }
        }
    }

    public function actionSubscription()
    {
        $subscription = new Subscription();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            if (!empty($data)) {
                $subscription->email = $data['email'];
                $subscription->subs_time = (string) time();

                if ($subscription->save()){       
                    return "<p style='color:green; margin-bottom: 0px;'>You subscribed!</p>";
                } else {
                    return "<p style='color:red; margin-bottom: 0px;'>Subscription error.</p>";
                }
            } 
        }
    }
}