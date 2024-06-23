<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip".
 *
 * @property int $id
 * @property string $number
 * @property string $price
 * @property int $count_seats
 * @property string $driver
 * @property string $date_tripe
 * @property string $type_bus
 * @property string $place_from
 * @property string $place_to
 *
 * @property Order[] $orders
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'price', 'count_seats', 'driver', 'type_bus', 'place_from', 'place_to'], 'required'],
            [['date_tripe'], 'safe'],
            [['number'], 'string', 'max' => 5 , 'min' => 5],
            [['driver', 'type_bus'], 'string', 'max' => 30],
            [['place_from', 'place_to'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер рейса',
            'price' => 'Цена за билет',
            'count_seats' => 'Количество свободных мест',
            'driver' => 'Водитель',
            'date_tripe' => 'Дата и время отправления',
            'type_bus' => 'Тип автобуса',
            'place_from' => 'Окуда',
            'place_to' => 'Куда',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['trip_id' => 'id']);
    }
}
