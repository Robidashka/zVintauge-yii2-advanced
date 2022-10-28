<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-dark']) ?>
        <?= Html::a('Добавать категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-dark']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'title',
            'description:html',
            'content:html',
            'created_at',
            'image',
            'viewed',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->author->username;  
                },
            ],
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->getArticleStatusLabel();
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->title;  
                },
            ],
        ],
    ]) ?>

</div>
