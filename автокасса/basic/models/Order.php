<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $username
 * @property int $count_seat
 * @property string $date
 * @property int $trip_id
 * @property float $price_end
 *
 * @property Trip $trip
 * @property User $username0
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'count_seat', 'trip_id', 'price_end'], 'required'],
            [['trip_id','count_seat'], 'integer'],
            [['date'], 'safe'],
            [['price_end'], 'number'],
            [['username'], 'string', 'max' => 20],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['username' => 'username']],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::class, 'targetAttribute' => ['trip_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Клиент',
            'count_seat' => 'Количество мест',
            'date' => 'Дата заказа',
            'trip_id' => 'Рейс',
            'price_end' => 'Стоимость за билеты',
        ];
    }

    /**
     * Gets query for [[Trip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::class, ['id' => 'trip_id']);
    }

    /**
     * Gets query for [[Username0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::class, ['username' => 'username']);
    }
}
