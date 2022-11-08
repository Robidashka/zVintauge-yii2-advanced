<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;

if(!$description = $model->description_about) {
	$description = "{$model->description_about}";
}

if(!$keywords = $model->keywords_about) {
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

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;?>
<section id="container">
	<div class="wrap-container">
		<!-----------------content-box-1-------------------->
		<section class="content-box box-1">
            <div class="item">
				<?php if(!empty($about->slider)){
					echo Html::img($about->slider, ['style' => 'width: 1000px']);
				}?>
	        </div>
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<div class="box-header">
						<h2><?php echo $about->title;?></h2>
					</div>
					<div class="box-content">
						<?php echo $about->description;?>
					</div>
				</div>
			</div>
		</section>
		<article class="single-post zerogrid">
			<div class="row wrap-post"><!--Start Box-->
				<div class="entry-content">
					<?php echo $about->text;?>
				</div>
			</div>
		</article>
    </div>
</section>