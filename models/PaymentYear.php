<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_year".
 *
 * @property int $pid
 * @property string $p_uuid
 * @property string $p_user
 * @property int $p_year
 * @property double $price_count
 *
 * @property PaymentHouse $pUu
 */
class PaymentYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_uuid'], 'required'],
            [['p_user'], 'required'],
            [['p_year'], 'integer'],
            [['price_count'], 'number'],
            [['p_uuid'], 'string', 'max' => 20],
            [['p_user'], 'string', 'max' => 20],
            [['p_uuid'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentHouse::className(), 'targetAttribute' => ['p_uuid' => 'uuid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pid' => 'Pid',
            'p_uuid' => 'P Uuid',
            'p_user' => 'P User uuid',
            'p_year' => 'P Year',
            'price_count' => 'Price Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUu()
    {
        return $this->hasOne(PaymentHouse::className(), ['uuid' => 'p_uuid']);
    }
}
