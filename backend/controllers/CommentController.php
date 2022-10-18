<?php

namespace backend\controllers;

use common\models\Comment;
use common\models\search\CommentSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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

    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('status asc')->all();
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'comments'=>$comments,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if($comment->archived())
        {
            return $this->redirect(['comment/index']);
        }
    }

    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);
        if($comment->allow())
        {
            return $this->redirect(['comment/index']);
        }
    }
    
    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);
        if($comment->disallow())
        {
            return $this->redirect(['comment/index']);
        }
    }
}