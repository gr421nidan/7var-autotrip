<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Trip $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_seat')->textInput() ?>

    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_tripe')->textInput() ?>

    <?= $form->field($model, 'type_bus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_to')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
