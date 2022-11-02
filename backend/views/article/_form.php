<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Article;
use common\models\Category;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

$Category = Category::find()->all();
?>
<div class="article-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'main_image')->widget(floor12\files\components\FileInputWidget::class) ?>

    <p>
        <?= Html::a('Добавить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-dark']) ?>
    </p>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]);?>

    <?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]);?>

    <?php echo $form->field($model, 'status')->dropdownList([
        0 => 'Черновик',
        1 => 'Опубликовано',
        2 => 'В архив',
    ]);?>

    <?php echo $form->field($model, 'category_id')->dropdownList(
        \yii\helpers\ArrayHelper::map($Category, 'id', 'title')
    );?>

    <?=\dvizh\seo\widgets\SeoForm::widget([
        'model' => $model, 
        'form' => $form, 
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
