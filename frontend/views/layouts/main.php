<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#a386b9">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, font, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-weight: inherit;
            font-style: inherit;
            font-size: 100%;
            vertical-align: baseline;
        }
        /* remember to define focus styles! */
        :focus {
            outline: 0;
        }
        body {
            line-height: 1;
            color: black;
            background: white;
        }
        ol, ul {
            list-style: none;
        }
        /* tables still need 'cellspacing="0"' in the markup */
        table {
            border-collapse: separate;
            border-spacing: 0;
        }
        caption, th, td {
            text-align: left;
            font-weight: normal;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: "";
        }
        blockquote, q {
            quotes: "" "";
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700&subset=cyrillic" rel="stylesheet">
    
    <?php $this->head() ?>
    
</head>
<body class="<?=\Yii::$app -> deviceDetect -> isMobile() ? 'body-mobile' :''?> <?=\Yii::$app -> deviceDetect -> isTablet()?'body-tablet':''?> <?= \Yii::$app->params['devicedetect']['isDesktop'] ? 'body-desktop' :''?>">
<?php $this->beginBody() ?>
<div class="wrap">
    <nav class="navbar-inverse navbar-fixed-top navbar" id="w0">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="hidden-xs hidden-sm pull-left">
                    <a class="navbar-brand" href="/" style="padding: 10px 10px;"><img src="/images/fb.png" srcset="/images/fb@2x.png 2x" alt="FB"></a>
                    <a class="navbar-brand" href="/" style="padding: 10px 10px;"><img src="/images/vk.png" srcset="/images/vk@2x.png 2x" alt="VK"></a>
                    <a class="navbar-brand" href="/" style="padding: 10px 10px;"><img src="/images/ok.png" srcset="/images/ok@2x.png 2x" alt="OK"></a>
                </div>
                <p class="ptserif bold js-brand-nav" style="<?=\Yii::$app->params['devicedetect']['isDesktop'] ?'display:none;':''?>float: left;font-size: 24px;margin-top: 7px;margin-bottom: 0;color: #434380;">
                    <?php if(Yii::$app -> request -> getUrl() == '/') { ?>
                        РС-Фиалки
                    <?php } else { ?>
                            <a href="/" class="non head-link">РС-Фиалки</a>
                    <?php } ?>
                </p>
                <?php
                if (!\Yii::$app->params['devicedetect']['isDesktop'])
                    echo \app\components\BasketCart::widget(['isMobile' => true])?>

                <div style="" class="search-wrapper js-search-wrapper  hidden-xs hidden-sm">
                    <button type="button" class="pull-left search_btn"></button>
                    <input type="text" class="search custom js-search" placeholder="Найти фиалку…">
                    <div class="search-results"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>
                </div>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li><a href="javascript:void(0)" class="js-login"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                    <li><a href="/site/about">О нас</a></li>
                    <li><a href="/site/contact">Контакты</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <?php
/*    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/']],
        ['label' => 'Каталог', 'url' => ['/catalog']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
        
    ];
    $menuItems[] = '<li>'.Html::img('/images/page-1.png').'</li>';
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    */?>
    <header>
        <div class="container hidden-xs hidden-sm">
            <div class="logo">
                <img src="/images/1.jpg">
            </div>
            <div class="logo-text">
                <p class="ptserif bold" style="font-size: 46px">РС-Фиалки</p>
                <p class="ptserif" style="font-size: 24px;">Интернет-магазин Репкиной Светланы<p>
            </div>
        </div>
        
    </header>
    <div class="container hidden-xs hidden-sm">
        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-12 col-md-12">
                <ul class="head-menu__menu">
                    <?php echo \app\components\HorizontalMenu::widget(['Menu' => [
                            ['url' => '/catalog', 'name' => 'Каталог'],
                            ['url' => '/catalog/special', 'name' => 'Спецпредложения'],
                            ['url' => 'javascript:void(0)', 'name' => 'Выставки'],
                            ['url' => 'javascript:void(0)', 'name' => 'Сеянцы'],
                            ['url' => '/catalog/all', 'name' => 'Все сорта РС'],
                    ]]) ?>
                </ul>
            <!--<ul class="head-menu__menu">
                    <li class="head-menu__menu-element "><a href="/catalog">Каталог</a></li>
                    <li class="head-menu__menu-element "><a href="/catalog/special">Спецпредложения</a></li>
                    <li class="head-menu__menu-element "><a href="#">Выставки</a></li>
                    <li class="head-menu__menu-element "><a href="#">Сеянцы</a></li>
                    <li class="head-menu__menu-element "><a href="/catalog/all">Все сорта РС</a></li>
            </ul>-->
        </div>
        </div>
    </div>
    <?php
    if (Yii::$app -> controller -> id != 'order' && \Yii::$app->params['devicedetect']['isDesktop'])
        echo \app\components\BasketCart::widget()?>
    <div class="container main-container">
        <div class="row">
            <?= Breadcrumbs::widget([
                    'homeLink'=>array(
                            'label' => 'Главная',  // required
                            'url' => '/' ),
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <!--<div class="col-md-3">
                <div class="left-menu" data-spy="affix" data-offset-top="60">
                    <?php /*echo \app\components\MenuWidget::widget()*/?>
                </div>
            </div>-->
                <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="pull-left">
            <a class="" href="/" style="padding: 10px 10px;"><img src="/images/fb.png" srcset="/images/fb@2x.png 2x" alt="FB"></a>
            <a class="" href="/" style="padding: 10px 10px;"><img src="/images/vk.png" srcset="/images/vk@2x.png 2x" alt="VK"></a>
            <a class="" href="/" style="padding: 10px 10px;"><img src="/images/ok.png" srcset="/images/ok@2x.png 2x" alt="OK"></a>
        </div>
        <p class="pull-right" style="margin-top: 7px;">&copy; РС-Фиалки <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
<script>
    $(function(){
        $('.js-menu-parent').on('click', function(){
            $(this).toggleClass('catalog-menu__item-open').find('.catalog-menu__child').slideToggle(400);
        });
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
