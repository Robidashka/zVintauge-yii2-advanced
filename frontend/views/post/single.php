<?php

use yii\helpers\Url;
use yii\helpers\Html;
use dvizh\seo\models\Seo;

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
								<span class="cat-links"><a href="<?= Url::toRoute(['blog/category', 'id' => $article->category->id]);?>"><?= $article->category->title;?></a></span>
							</div>
							<div class="post-thumbnail-wrap">
								<img src="<?= $article->getImage();?>">
							</div>
							<div class="entry-content">
								<p><?= $article->content;?></p>
							</div>
							<div class="viewed"> 
								<p class="viewed-1 border-view">&#128065</p> 
								<p class="viewed-2"><?= (int) $article->viewed;?></p>
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
                						'commentForm'=>$commentForm
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