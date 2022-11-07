<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'SEO главных страниц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Seo-index">
    
    <?php $form = ActiveForm::begin();?>

        <h2>SEO главной страницы</h2>

            <?= $form->field($model, 'h1_home')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords_home')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_home')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text_home')->textArea(['maxlength' => true]) ?>

        <h2>SEO страницы "О нас"</h2>

            <?= $form->field($model, 'h1_about')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords_about')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_about')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text_about')->textArea(['maxlength' => true]) ?>
    
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>