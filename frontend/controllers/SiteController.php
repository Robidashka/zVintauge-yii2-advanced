<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\Article;
use yii\helpers\ArrayHelper;
use common\models\Seo;
use common\models\About;
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
        $id = Seo::find()->max('id');
        $model = Seo::find()->where(['id'=>$id])->one();
        $articles = Article::find()->where(['status'=>1])->all();
        // $block = Block::find()->where(['page_id'=>self::PAGE_HOME])->all();
        //$block = Block::getIndexedBlockArray();

        $page = Page::find()->where(['key' => 'home'])->one();
        $block = $page->getIndexedBlockArray();

        return $this->render('index',[
            'articles' => $articles, 
            'model' => $model, 
            'page' => $page,
            'block' => $block,
        ]);
    }

    public function actionAbout()
    {
        $id = Seo::find()->max('id');
        $model = Seo::find()->where(['id'=>$id])->one();
        $id = About::find()->max('id');
        $about = About::find()->where(['id'=>$id])->one();
        return $this->render('about',['model' => $model, 'about' => $about]);
    }
}
