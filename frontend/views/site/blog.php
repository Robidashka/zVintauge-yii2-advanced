<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;


/** @var yii\web\View $this */

$this->title = 'zVintauge | Blog';
?>
<div class="wrap-body">
	<section id="container">
		<div class="wrap-container">
			<div id="main-content">
				<div class="wrap-content">
					<div class="row">
						<article class="single-post zerogrid">
							<div class="search11">
								<form action="<?= Url::to(['site/search']); ?>" method="get" class="search1">
									<input type="text" class="search" name="search" placeholder="Search">
                                    <input type="submit" name="submit" class="submit" value="Search">
								</form>
							</div>
							<?php if(!empty($articles)): foreach($articles as $article):?> 
								<div class="row wrap-post">
									<div class="entry-header">
										<span class="time"><?= $article->getDate();?> by <?= $article->author->username;?></span>
										<h2 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id])?>"><?= $article->title;?></a></h2>
										<span class="cat-links"><a href="<?= Url::toRoute(['site/category', 'id' => $article->category->id]);?>"><?= $article->category->title;?></a></span>
									</div>
									<div class="post-thumbnail-wrap">
										<img src="<?= $article->getImage();?>">
									</div>
									<div class="entry-content">
										<p><?= $article->description;?></p>
										<center><a class="button " href="<?= Url::toRoute(['site/view', 'slug'=>$article->slug])?>">Read More</a></center>
									</div>
									<div class="viewed"> 
										<p class="viewed-1 border-view">&#128065</p> 
										<p class="viewed-2"><?= (int) $article->viewed;?></p>
									</div>
								</div>
							<?php endforeach; else: echo "<h2 class=\"margin\">Nothing found...</h2>"; endif;?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="center">
<?php   
    if(!empty($articles)):
	    echo LinkPager::widget([
	    	'pagination' => $pagination,
	    ]);
    endif;
?>
</div>