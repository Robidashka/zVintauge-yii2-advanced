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
		['label' => 'Контент страницы "О нас"', 'url' => ['/about/index']],
		['label' => 'SEO главных страниц', 'url' => ['/seo/index']],
		['label' => 'Статьи', 'url' => ['/article/index']],
		['label' => 'Категории', 'url' => ['/category/index']],
		['label' => 'Комментарии', 'url' => ['/comment/index']],
		['label' => 'Пользователи', 'url' => ['/user/index']],
	]]) ?>
</div>
