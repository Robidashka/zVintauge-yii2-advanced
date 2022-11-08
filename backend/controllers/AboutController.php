<?php

namespace backend\controllers;

use andrewdanilov\adminpanel\controllers\BackendController;
use yii\filters\VerbFilter;
use Yii;
use common\models\About;

class AboutController extends BackendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new About();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->render('index', [
                'model' => $model,
            ]);
        } 
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}