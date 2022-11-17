<?php

use yii\helpers\Url;
use yii\helpers\Html;
use dvizh\seo\models\Seo;
use yii\widgets\ActiveForm;

if(!$title = $article->seo->title) {
	$title = "{$seo->title}";
}

if(!$description = $article->seo->description) {
	$description = "{$seo->description}";
}

if(!$keywords = $article->seo->keywords) {
	$keywords = '';
}

$this->registerMetaTag([
	'name' => 'description',
	'content' => $description,
]);

$this->registerMetaTag([
	'name' => 'keywords',
	'content' => $keywords,
]);

$this->title = $title;?>
<section id="container">
	<div class="wrap-container">
		<!-----------------Content-Box-------------------->
		<div id="main-content">
			<div class="wrap-content">
				<div class="row">
					<article class="single-post zerogrid">
						<div class="row wrap-post"><!--Start Box-->
							<div class="entry-header">
								<span class="time"><?= $article->getDate();?>  by <?= $article->author->username;?></span>
								<h2 class="entry-title"><a><?= $article->title;?></a></h2>
								<span class="cat-links">
									<?php if(!empty($article->category)){
										echo Html::a($article->category->title, ['/category/', 'slug'=>$article->category->slug]);
									}?>
								</span>
							</div>
							<div class="post-thumbnail-wrap">
								<?php echo Html::img($article->main_image);?>
							</div>
							<div class="entry-content">
								<p><?= $article->content;?></p>
							</div>
							<div class="viewed"> 
								<p class="viewed-1 border-view">&#128065</p> 
								<p class="viewed-2"><?= (int) $article->viewed;?></p>
								<button data-trigger>Open modal</button>
							</div>
						</div>
					</article>
					<div class="zerogrid">
						<div class="comments-are">
							<div id="comment">
								<div>
									<?= $this->render('comment', [
                						'article'=>$article,
                						'comments'=>$comments,
                						'model'=>$model
            						])?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal-container">
	<div class="modal-content">
		<button class="close">x</button>
		<h1>Enter your desired mail to send</h1>
		<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'form-signup'])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($mailing, 'email')->textarea(['class'=>'form-control','placeholder'=>'Enter your email'])->label(false)?>
				<?= $form->field($mailing, 'agree')->checkbox([
            		'template' => "<div class=\"agree\"> {label} {input}</div>\n<div class=\"\">{error}</div>",
        		]) ?>
            </div>
        </div>
        <center><button type="submit" class="com-btn">I want newsletter</button></center>
        <?php \yii\widgets\ActiveForm::end();?>
	</div>
</div>
<script>
	(function(){
    var modal = document.querySelector('.modal-container');
    var closeButton = document.querySelector('.close');
    var modalTriggers = document.querySelectorAll('[data-trigger]');
  
    var isModalOpen = false;
    var pageYOffset = 0;
  
    var openModal = function() {
      pageYOffset = window.pageYOffset;
      modal.classList.add('is-open');
      isModalOpen = true;
    }
  
    var closeModal = function() {
      modal.classList.remove('is-open');
      isModalOpen = false;
    }
  
    var onScroll = function(e) {
      if (isModalOpen) {
        e.preventDefault();
        window.scrollTo(0, pageYOffset);
      }
    }
  
    modalTriggers.forEach(function(item) { 
      item.addEventListener('click', openModal);
    })
  
    document.addEventListener('scroll', onScroll);
  
    closeButton.addEventListener('click', closeModal);
  })();
</script>