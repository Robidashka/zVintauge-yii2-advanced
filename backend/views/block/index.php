<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Блоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1>Блоки</h1>

    <p>
        <?= Html::a('Создать блок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'page_id',
            'index',
            'title',
            [
                'attribute' => 'content',
                'format' => 'html',
            ],
            [
                'class' => \andrewdanilov\gridtools\FontawesomeActionColumn::class,
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>


</div>