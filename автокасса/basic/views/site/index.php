<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Добро пожаловать в автокассу!</h1>

        <p class="lead">Желаете купить билет?</p>
        <?php if (!Yii::$app->user->isGuest): ?>
            <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to(['trip/index']) ?>">Заказать билеты</a>
            </p>
        <?php else: ?>
            <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to(['site/login']) ?>">Заказать билеты</a>
            </p>
        <?php endif; ?>
    </div>

</div>
