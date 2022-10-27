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

        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Автор</td>
                    <td>Текст</td>
                    <td>Действие</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach($comments as $comment):?>
                    <tr>
                        <td><?= $comment->id?></td>
                        <td><?= $comment->user->username?></td>
                        <td><?= $comment->text?></td>
                        <td>
                            <?php if($comment->status == 0):?>
                                <a class="btn btn-success" href="<?= Url::toRoute(['comment/allow', 'id'=>$comment->id]);?>">Разрешать</a>
                                <a class="btn btn-danger" href="<?= Url::toRoute(['comment/archiv', 'id'=>$comment->id]); ?>">Удалить</a>
                            <?php elseif($comment->status == 1):?>
                                <a class="btn btn-danger" href="<?= Url::toRoute(['comment/archiv', 'id'=>$comment->id]); ?>">Удалить</a>
                            <?php else:?>
                                <a class="btn btn-success" href="<?= Url::toRoute(['comment/allow', 'id'=>$comment->id]);?>">Разрешать</a>
                            <?php endif?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Статус',
                    'value' => function($data){
                        return $data->getStatusLabel();
                    }
                ],
                'id',
                'text',
                'user_id',
                'article_id',  
                'date',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],    
            ],
        ]) ?>

    <?php endif;?>
</div>