<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1>Статьи</h1>

    <p>
        <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'status',
                'filter' => ['0' => 'Черновик', '1' => 'Опубликовано', '2' => 'В архиве'],
                'filterInputOptions' => ['prompt' => 'Все статусы', 'class' => 'form-control', 'id' => null],
                'value' => function($data){
                    return $data->getArticleStatusLabel();
                }
            ],
            'title',
            [
                'attribute' => 'description',
                'format' => 'html',
            ],
            [
                'attribute' => 'created_at',
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'created_at',
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                ]),
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'updated_at',
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'updated_at',
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                ]),
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->author->username;  
                },
            ],
            'viewed',
            [
                'class' => \andrewdanilov\gridtools\FontawesomeActionColumn::class,
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>


</div>
