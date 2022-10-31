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


class PostController extends Controller
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

    public function actionPost($slug)
    {
        $article = Article::find()->where(['slug'=>$slug])->one();
        $comments = $article->getArticleComments();
        $model = new CommentForm();
        $article->viewedCount();

        return $this->render('single', [
            'article'=>$article,
            'comments'=>$comments,
            'model'=>$model
        ]);
    }

    public function actionComment($id, $slug)
    {
        // $model = new CommentForm();
        // $article = Article::find()->where(['slug'=>$slug])->one();
        // $comments = $article->getArticleComments();
        
        // if(Yii::$app->request->isPost)
        // {
        //     if( $model->load(Yii::$app->request->post()) && $model->saveComment($id))
        //     {
        //         $model = new CommentForm();
        //         Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
        //         return $this->redirect(['post/post','slug'=>$slug]);
        //     }
        // }

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
}