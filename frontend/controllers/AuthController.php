<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
use common\models\User;
use common\models\SignupForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('/auth/login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->signup()) {
                $user = $model->getUser($model->username);
                Yii::$app->user->login($user, 3600 * 24 * 30);
                return $this->goHome();
            } 

        }

        return $this->render('/auth/signup', [
            'model' => $model
        ]);
    }
}