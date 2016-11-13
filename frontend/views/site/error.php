<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1 class="text-center">Ошибка <?=$exception -> statusCode?></h1>

    <div class="alert alert-danger" style="font-size:18px;">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p class="h3 col-md-12">
        The above error occurred while the Web server was processing your request.
    </p>
    <p class="h3 col-md-12">
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
