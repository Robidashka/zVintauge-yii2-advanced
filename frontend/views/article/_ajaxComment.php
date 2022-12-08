<?php if(!empty($comment)):?>
    <div class="bottom-comment"><!--bottom comment-->
        <div class="comment-text">
            <h5 class="comment-style"><?= $comment->getDate();?> by <?= $comment->user->username;?></h5>
            <p class="para"><?= $comment->text; ?></p>
        </div>
    </div>
<?php endif;?>

<div class="clear_session">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <?= Yii::$app->session->getFlash('success') ?>
    <?php endif;?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <?= Yii::$app->session->getFlash('error') ?>
    <?php endif;?>
</div>