<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Blocks;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

?>
<div class="">

    <?php $form = ActiveForm::begin();?>

        <?= $form->field($model, 'index')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]);?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>