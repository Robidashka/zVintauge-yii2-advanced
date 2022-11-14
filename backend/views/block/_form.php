<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Block;
use common\models\Page;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

$page = Page::find()->all();
?>
<div class="">

    <?php $form = ActiveForm::begin();?>

        <?php echo $form->field($model, 'page_id')->dropdownList(
            \yii\helpers\ArrayHelper::map($page, 'id', 'page_name')
        );?>

        <?php echo $form->field($model, 'index')->dropdownList([
                'block0' => 'Первый блок',
                'block1' => 'Второй блок',
                'block2' => 'Третий блок',
        ]);?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]);?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>