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
<div class="">

    <?php $form = ActiveForm::begin();?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?php echo $form->field($model, 'category_id')->dropdownList(
                    \yii\helpers\ArrayHelper::map($Category, 'id', 'title')
                );?>

                <?php echo $form->field($model, 'status')->dropdownList([
                        0 => 'Черновик',
                        1 => 'Опубликовано',
                        2 => 'В архив',
                ]);?>
            </div>
            <div class="col">
                <?= $form->field($model, 'main_image')->widget(floor12\files\components\FileInputWidget::class) ?>
            </div>
        </div>
        
        <?php echo $form->field($model, 'description')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]);?>

        <?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]);?>

        <?=\dvizh\seo\widgets\SeoForm::widget([
            'model' => $model, 
            'form' => $form, 
        ]); ?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>