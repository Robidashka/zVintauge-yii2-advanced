<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;

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

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;?>
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
		<article class="single-post zerogrid">
			<div class="row wrap-post"><!--Start Box-->
				<div class="entry-content">
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
		</article>
		<article class="single-post zerogrid">
			<div class="row wrap-post"><!--Start Box-->
				<div class="entry-content">
					<?php if(!empty($block['block2'])):?>
						<div class="box-header">
							<h2><?php echo $block['block2']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['block2']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</article>
    </div>
</section>