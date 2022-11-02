<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="article-form">

    <h1>Выберете изображение</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>