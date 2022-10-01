<?php

namespace backend\controllers;

//use andrewdanilov\adminpanel\controllers\BackendController;
use common\models\Comment;
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
        $comments = Comment::find()->orderBy('id desc')->all();
        
        return $this->render('index',['comments'=>$comments]);
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if($comment->delete())
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