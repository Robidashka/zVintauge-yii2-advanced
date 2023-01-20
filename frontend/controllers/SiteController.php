<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\Article;
use yii\helpers\ArrayHelper;
use common\models\Block;
use common\models\Page;

class SiteController extends Controller
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
        $articles = Article::find()->where(['status'=>1])->all();
        $page = Page::find()->where(['key' => 'home'])->one();

        if(!empty($page)){
            $block = $page->getIndexedBlockArray();

            return $this->render('index',[
                'articles' => $articles, 
                'page' => $page,
                'block' => $block,
            ]);
        }

        return $this->render('index',[
            'articles' => $articles, 
            'page' => $page,
        ]);
    }

    public function actionAbout()
    {
        $page = Page::find()->where(['key' => 'about'])->one();
        
        if(!empty($page)){
            $block = $page->getIndexedBlockArray();

            return $this->render('about',[
                'page' => $page,
                'block' => $block,
            ]);
        }

        return $this->render('about',[
            'page' => $page,
        ]);
    }
}
