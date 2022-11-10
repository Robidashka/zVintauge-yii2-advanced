<?php

use andrewdanilov\adminpanel\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $siteName string */
/* @var $directoryAsset false|string */

?>

<div class="page-left">
	<div class="sidebar-heading"><?= $siteName ?></div>
	<?= Menu::widget(['items' => [
		['label' => 'Панель управления', 'url' => ['/site/index']],
		['label' => 'Страницы', 'url' => ['/page/index']],
		['label' => 'Блоки', 'url' => ['/block/index']],
		['label' => 'Статьи', 'url' => ['/article/index']],
		['label' => 'Категории', 'url' => ['/category/index']],
		['label' => 'Пользователи', 'url' => ['/user/index']],
		['label' => 'Комментарии', 'url' => ['/comment/index']],
	]]) ?>
</div>
