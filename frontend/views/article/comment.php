<?php
    $this->registerJs(
        '$(".contact-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr(\'action\'); 
            $.ajax({
                url: url,
                type: \'post\',
                dataType: \'json\',
                data: data
            })
            .done(function(response) {
                if (response.data.success == true) {
                    event.target.reset();
                    $( "#comments" ).load(window.location.href + " #comments" );
                }
            })
            .fail(function() {
                console.log("error");
            });
        });'
    );
?>
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
            'action'=>['article/comment', 'id'=>$article->id, 'slug'=>$article->slug],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($model, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <center><button type="submit" class="com-btn">Post Comment</button></center>
        <?php \yii\widgets\ActiveForm::end();?>
    </div><!--end leave comment-->
<?php else:?>
    <h5 class="center">Login or signup to write comments</h5>
<?php endif;?>