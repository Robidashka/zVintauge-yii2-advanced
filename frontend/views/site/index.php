<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\ActiveQuery;

if(!empty($page)){
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
}

if(!empty($page)){
	$this->title = $title;
}
?>
<section id="container">
	<div class="wrap-container">
		<!-----------------content-box-1-------------------->
		<section class="content-box box-1">
			<div class="item1">
				<div class="slider">
					<?php if(!empty($page->slider)): foreach ($page->slider as $slider):?>
						<div class="item">
							<?php if(!empty($page->slider)){echo Html::img($slider->href, ['style' => 'width: 1000px; object-fit: cover; height: 560px']);}?>
						</div>
						<a class="previous" onclick="previousSlide()">&#10094;</a>
						<a class="next" onclick="nextSlide()">&#10095;</a>
					<?php endforeach;endif;?>
				</div>
	        </div>
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['block0'])):?>
						<div class="box-header">
							<h2><?php echo $block['block0']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['block0']['content'];?>
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
										<h3><a href="<?= Url::toRoute(['article/view', 'slug'=>$article->slug])?>"><?= $article->title;?></a></h3>
										<span class="cat-links">
											<?php if(!empty($article->category)){
												echo Html::a($article->category->title, ['/category', 'slug'=>$article->category->slug]);
											}?>
										</span>
										<p><?= $article->description;?></p>
										<a class="button" href="<?= Url::toRoute(['article/view', 'slug'=>$article->slug])?>">Read More</a>
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
					<?php if(!empty($block['block1'])):?>
						<div class="box-header">
							<h2><?php echo $block['block1']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['block1']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		<section class="content-box box-3">
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['block2'])):?>
						<div class="box-header">
							<h2><?php echo $block['block2']['title'];?></h2>
						</div>
						<div class="box-content">
							<blockquote><?php echo $block['block2']['content'];?></blockquote>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
	</div>
</section>