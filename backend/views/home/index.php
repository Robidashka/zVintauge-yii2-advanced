<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);


$this->title = 'Контент главной страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Content-index">
    
    <?php $form = ActiveForm::begin();?>

        <h2>Контент главной страницы</h2>
       
            <?= $form->field($model, 'slider')->widget(floor12\files\components\FileInputWidget::class)?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true])?>

            <?php echo $form->field($model, 'description')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
            ]);?>

            <?php echo $form->field($model, 'text')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
            ]);?>
    
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end(); ?>
</div>