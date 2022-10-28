<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\grid\ActionColumn;

$this->title = 'Коментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1>Комментарии</h1>

    <?php if(!empty($comments)):?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'article_id',
                    'value' => function($data) {
                        return $data->article->title;  
                    }, 
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function($data) {
                        return $data->user->username;  
                    },
                ],
                'text',
                [
                    'attribute' => 'date',
                    'filter' => \yii\jui\DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'date',
                        'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                    ]),
                    'format' => ['date', 'php:Y-m-d'],
                ],
                [
                    'attribute' => 'status',
                    'filter' => ['0' => 'На рассмотрении', '1' => 'Разрешен', '2' => 'В архиве'],
                    'filterInputOptions' => ['prompt' => 'Все статусы', 'class' => 'form-control', 'id' => null],
                    'value' => function($data){
                        return $data->getCommentStatusLabel();
                    }
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if($model->status == 0){
                            return '<a class="btn btn-success" href="' . Url::toRoute(['comment/allow', 'id'=>$model->id]) . '">O</a>' . ' ' .
                            '<a class="btn btn-danger" href="' . Url::toRoute(['comment/archiv', 'id'=>$model->id]) . '">X</a>';
                        }
                        elseif($model->status == 1){
                            return '<a class="btn btn-danger" href="' . Url::toRoute(['comment/archiv', 'id'=>$model->id]) . '">X</a>';
                        }
                        else{
                            return '<a class="btn btn-success" href="' . Url::toRoute(['comment/allow', 'id'=>$model->id]) . '">O</a>';
                        }
                    },
                ],  
            ],
        ]) ?>

    <?php endif;?>
</div>