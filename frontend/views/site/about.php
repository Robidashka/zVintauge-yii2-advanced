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
            <div class="item">
				<?php if(!empty($page->slider)){
					echo Html::img($page->slider, ['style' => 'width: 1000px']);
				}?>
	        </div>
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<?php if(!empty($block['about0'])):?>
						<div class="box-header">
							<h2><?php echo $block['about0']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['about0']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		<article class="single-post zerogrid">
			<div class="row wrap-post"><!--Start Box-->
				<div class="entry-content">
					<?php if(!empty($block['about1'])):?>
						<div class="box-header">
							<h2><?php echo $block['about1']['title'];?></h2>
						</div>
						<div class="box-content">
							<?php echo $block['about1']['content'];?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</article>
    </div>
</section>