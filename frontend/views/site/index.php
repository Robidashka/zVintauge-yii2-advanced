<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Home';?>
<section id="container">
	<div class="wrap-container">
		<!-----------------content-box-1-------------------->
		<section class="content-box box-1">
            <div class="item">
		        <img src="images/slide1.jpg" />
	        </div>
			<div class="zerogrid">
				<div class="wrap-box"><!--Start Box-->
					<div class="box-header">
						<h2>ABOUT US</h2>
					</div>
					<div class="box-content">
						<p>Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla <br>fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. <br>Aliquam et elit eu nunc rhoncus viverra quis at felis. Sed do</p>
					</div>
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
								<div class="col-1-2 <? if($state) echo "f-right";?>">
									<img src="<?= $article->getImage();?>">
								</div>
								<div class="col-1-2">
									<div class="entry-content t-center">
										<h3><?= $article->title;?></h3>
										<p><?= $article->description;?></p>
										<a class="button" href="<?= Url::toRoute(['view/view', 'slug'=>$article->slug])?>">Read More</a>
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
					<div class="box-header">
						<h2>OUR PHILOSOPHY</h2>
					</div>
					<div class="box-content">
						<div class="row">
							<div class="col-1-2">
								<div class="wrap-col">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril.</p>
								</div>
							</div>
							<div class="col-1-2">
								<div class="wrap-col">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril.</p>
								</div>
							</div>
						</div>
						<div class="row">
							<blockquote><p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet vultatup duista.</p></blockquote>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section>