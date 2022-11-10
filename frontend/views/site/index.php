<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\ActiveQuery;

if(!$title = $page->seo->title) {
	$title = "{$seo->title}";
}

if(!$description = $page->seo->description) {
	$description = "{$seo->description}";
}

if(!$keywords = $page->seo->keywords) {
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
		<!-----------------content-box-1-------------------->
		<section class="content-box box-1">
            <div class="item">
				<?php if(!empty($page->slider)){
					echo Html::img($page->slider, ['style' => 'width: 1000px']);
				}?>
	        </div>
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['home0'])):?>
						<div class="box-header">
							<h2><?php echo $block['home0']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['home0']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		<!-----------------content-box-2-------------------->
		<section class="content-box box-style-1 box-4">
			<div class="zerogrid" style="width: 100%">
				<div class="wrap-box"><!--Start Box-->
				<? $state = false;?>
					<?php foreach($articles as $article):?>
						<? $state = !$state;?>
						<div class="row">
							<article>
								<div class="col-1-2 t-center <? if($state) echo "f-right";?>">
									<?php echo Html::img($article->main_image);?>
								</div>
								<div class="col-1-2 ">
									<div class="entry-content t-center">
										<h3><a href="<?= Url::toRoute(['post/post', 'slug'=>$article->slug])?>"><?= $article->title;?></a></h3>
										<span class="cat-links">
											<?php if(!empty($article->category)){
												echo Html::a($article->category->title, ['article/category', 'id' => $article->category->id]);
											}?>
										</span>
										<p><?= $article->description;?></p>
										<a class="button" href="<?= Url::toRoute(['post/post', 'slug'=>$article->slug])?>">Read More</a>
									</div>
								</div>
							</article>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		</section>
		<!-----------------content-box-3-------------------->
		<section class="content-box box-3">
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['home1'])):?>
						<div class="box-header">
							<h2><?php echo $block['home1']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['home1']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		<section class="content-box box-3">
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['home2'])):?>
						<div class="box-header">
							<h2><?php echo $block['home2']['title'];?></h2>
						</div>
						<div class="box-content">
							<blockquote><?php echo $block['home2']['content'];?></blockquote>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
	</div>
</section>