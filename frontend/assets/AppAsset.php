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
        '//cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css',
        '/css/font-awesome.min.css',
        '/css/likely.css',
        '/js/chosen/chosen.css',
        '/css/jquery.scrollbar.css',
        '/css/site.css',
        '/css/style.css',
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js',
        '/js/likely.js',
        '//cdn.rawgit.com/RobinHerbots/jquery.inputmask/3.2.7/dist/min/jquery.inputmask.bundle.min.js',
        '/js/jquery.inputmask-multi.min.js',
        '/js/chosen/chosen.jquery.min.js',
        '/js/jquery.scrollbar.min.js',
        '/js/jquery-ias.min.js',
        '/js/script.js?v=1.0.0',
        //'https://use.fontawesome.com/9fb7b05f95.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
