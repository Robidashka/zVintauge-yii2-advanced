<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
