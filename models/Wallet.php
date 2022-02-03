<?php


namespace app\models;

use yii\db\ActiveRecord;
use yii\validators\NumberValidator;
use yii\validators\RangeValidator;
use yii\validators\RequiredValidator;


class Wallet extends ActiveRecord
{

    const CURRENCY_RUB = 0;
    const CURRENCY_USD = 1;


    public static function tableName()
    {
        return '{{%wallet}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'currency', 'amount'], RequiredValidator::class],
            [['amount'], NumberValidator::class],
            [['user_id', 'currency'], NumberValidator::class, 'integerOnly' => true],
            [['currency'], RangeValidator::class, 'range' => [static::CURRENCY_RUB, static::CURRENCY_USD]],
        ];
    }

    /**
     * Get list of supported currencies
     *
     * @return array
     */
    public static function getCurrencyList()
    {
        return [
            static::CURRENCY_RUB => 'RUB',
            static::CURRENCY_USD => 'USD',
        ];
    }

    /**
     * Get abbreviation of Wallet currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return static::getCurrencyList()[$this->currency];
    }

}
