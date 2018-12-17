<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_house".
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $month_pay
 * @property int $price_pay
 * @property string $currency
 * @property string $dop_pay
 * @property string $date_pay
 * @property string $name_pay
 *
 * @property User $user
 * @property PaymentYear[] $paymentYears
 */
class PaymentHouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_house';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'user_id', 'month_pay', 'price_pay', 'currency', 'name_pay'], 'required'],
            [['user_id', 'price_pay'], 'integer'],
            [['dop_pay'], 'string'],
            [['date_pay'], 'safe'],
            [['uuid'], 'string', 'max' => 20],
            [['month_pay'], 'string', 'max' => 15],
            [['currency'], 'string', 'max' => 3],
            [['name_pay'], 'string', 'max' => 50],
            [['uuid'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'user_id' => 'User ID',
            'month_pay' => 'Month Pay',
            'price_pay' => 'Price Pay',
            'currency' => 'Currency',
            'dop_pay' => 'Dop Pay',
            'date_pay' => 'Date Pay',
            'name_pay' => 'Name Pay',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentYears()
    {
        return $this->hasMany(PaymentYear::className(), ['p_uuid' => 'uuid']);
    }
}
