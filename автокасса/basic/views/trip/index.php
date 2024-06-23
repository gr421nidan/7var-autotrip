<?php

use app\models\Trip;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Рейсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить рейс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="form-search">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]);
        ?>
        <?= $form->field($searchModel, 'search')->textInput(['placeholder' => 'Поиск...'])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'number',
        'type_bus',
        'count_seats',
        'price',
        'driver',
        'date_tripe',
        'place_from',
        'place_to'];
    if (Yii::$app->user->identity->isAdmin()) {
        $columns[] = ['class' => ActionColumn::className(),
            'urlCreator' => function ($action, Trip $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }];
    } else {
        $columns[] = [
            'format' => 'raw',
            'value' => function ($model) {
                return Html::beginForm(['/trip/order', 'id' => $model->id])
                    . Html::textInput('count_seat', 0)
                    . Html::submitButton(
                        'Заказать',
                        ['class' => 'btn btn-success']
                    )
                    . Html::endForm();
            }
        ];
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns
    ]);
    ?>


</div>
