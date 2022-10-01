<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="zerogrid">
<div class="site-login gray">
    <h1><?= Html::encode($this->title) ?></h1>

    <p >Please fill out the following fields to Signup:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>


        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
            <center><?= Html::submitButton('Login', ['class' => 'com-btn', 'name' => 'login-button']) ?></center>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>