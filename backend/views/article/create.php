<?php

use yii\helpers\Html;

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1>Саздание статьи</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
