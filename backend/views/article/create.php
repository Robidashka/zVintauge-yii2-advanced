<?php

use yii\helpers\Html;

$this->title = 'Создать статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1>Саздание статьи</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
