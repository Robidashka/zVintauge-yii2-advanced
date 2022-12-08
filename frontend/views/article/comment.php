<?php

use yii\bootstrap4\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(['id' => 'pjax-comment-show'] ); ?>
<div id="comments">
    <?php if(!empty($comments)):?>
        <?php foreach($comments as $comment):?>
            <div class="bottom-comment"><!--bottom comment-->
                <div class="comment-text">
                    <h5 class="comment-style"><?= $comment->getDate();?> by <?= $comment->user->username;?></h5>
                    <p class="para"><?= $comment->text; ?></p>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
<?php Pjax::end();?>
<!-- end bottom comment-->
<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        
        <?php $form = \yii\widgets\ActiveForm::begin([
            'options'=>['class'=>'form-horizontal contact-form', 'id'=>'contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($model, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <center><button type="submit" data-article-id="<?= $article->id ?>" id='comment-btn' class="com-btn">Post Comment</button></center>
        <?php \yii\widgets\ActiveForm::end();?>
    </div><!--end leave comment-->
<?php else:?>
    <h5 class="center">
        <?php echo Html::a('Login', '/login', ['class' => 'log-sig']);?> or 
        <?php echo Html::a('signup', '/signup', ['class' => 'log-sig']);?> to write comments
    </h5>
<?php endif;?>