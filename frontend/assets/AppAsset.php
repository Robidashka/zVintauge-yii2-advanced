<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/zerogrid.css',
	    'css/style.css',
        'css/font-awesome.min.css',
	    'css/menu.css',
    ];
    public $js = [
        'js/jquery1111.min.js',
	    'js/script.js',
    ];
    public $depends = [
    ];
}
