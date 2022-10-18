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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'slug',
            'title',
            [
                'attribute' => 'description',
                'format' => 'html',
            ],
            // [
            //     'attribute' => 'content',
            //     'format' => 'html',
            // ],
            'created_at',
            'updated_at',
            'viewed',
            'user_id',
            // [
            //     'format' => 'html',
            //     'label' => 'Изображение',
            //     'value' => function($data){
            //         return Html::img($data->getImage(), ['width'=>200]);
            //     }
            // ],
            //'image',
            //'status',
            //'category_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
