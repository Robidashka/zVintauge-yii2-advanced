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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($comments)):?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'status',
                    'value' => function($data){
                        return $data->getStatusLabel();
                    }
                ],
                'text',
                'user_id',
                'article_id',  
                'date',
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