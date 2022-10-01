<?php

/** @var yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
//use app\assets\MainAsset;
use widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="home-page">
<?php $this->beginBody() ?>
    <div class="wrap-body">

		<header class="">
			<div class="logo">
				<a href="/">zVintauge</a>
				<span>Collectible Vintage & Antique Photos</span>
			</div>
			<div id="cssmenu" class="align-center">
				<ul>
					<li><a href="<?= Url::toRoute(['/'])?>"><span>Home</span></a></li>
					<li><a href="<?= Url::toRoute(['/blog'])?>"><span>Blog</span></a></li>
					<li><a href="<?= Url::toRoute(['/about'])?>"><span>About</span></a></li>
					<?php if(Yii::$app->user->isGuest):?>
	    	            <li><a href="<?= Url::toRoute(['/login'])?>">Login</a></li>
	    	            <li class="last"><a href="<?= Url::toRoute(['/signup'])?>">Register</a></li>
	    	        <?php else: ?>
	    	            <?= Html::beginForm(['/logout'], 'post', ['class' => 'logout-form'])
	    	            . Html::submitButton(
	    	                'Logout (' . Yii::$app->user->identity->username . ')',
	    	                ['class' => 'logout-btn last']
	    	            )
	    	            . Html::endForm() ?>
	    	        <?php endif;?>
				</ul>
			</div>
		</header>

		<?= $content?>
        
		<footer>
			<div class="zerogrid wrap-footer">
				<div class="row">
					<div>
						<div class="wrap-col">
							<h3 class="widget-title center">About Us</h3>
							<p class="center">Ut volutpat consectetur aliquam. Curabitur auctor in nis ulum ornare. Metus elit vehicula dui. Curabitur auctor in nis ulum ornare. Sed consequat, augue condimentum fermentum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque la udantium</p>
						</div>
					</div>
				</div>
			</div>
			<div class="zerogrid bottom-footer">
				<div class="copyright">
					Copyright @ - Designed by <a href="https://www.zerotheme.com">ZEROTHEME</a>
				</div>
			</div>
		</footer>

	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
