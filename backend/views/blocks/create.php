<?php

use yii\helpers\Html;

$this->title = 'Создание блока';
$this->params['breadcrumbs'][] = ['label' => 'Блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1>Саздание блока</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
