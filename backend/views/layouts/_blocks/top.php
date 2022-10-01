<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\bootstrap4\Nav;

?>

<div class="page-top">
	<div class="top-header"><?= $this->title ?></div>
	<div class="profile-panel">
		<div class="profile-item">
			<span class="small">
				<?php
    				NavBar::begin([
    				]);
    				if (Yii::$app->user->isGuest) {
    				    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    				} else {
    				    $menuItems[] = '<li>'
    				        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
    				        . Html::submitButton(
    				            'Logout (' . Yii::$app->user->identity->username . ')',
    				            ['class' => 'btn btn-link logout']
    				        )
    				        . Html::endForm()
    				        . '</li>';
    				}
    				echo Nav::widget([
    				    'options' => ['class' => 'navbar-nav'],
    				    'items' => $menuItems,
    				]);
    				NavBar::end();
    			?>
			</span>
		</div>
	</div>
</div>