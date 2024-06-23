<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TripSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'count_seat') ?>

    <?= $form->field($model, 'driver') ?>

    <?php // echo $form->field($model, 'date_tripe') ?>

    <?php // echo $form->field($model, 'type_bus') ?>

    <?php // echo $form->field($model, 'place_from') ?>

    <?php // echo $form->field($model, 'place_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
