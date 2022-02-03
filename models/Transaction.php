<?php


namespace app\models;

use yii\db\ActiveRecord;
use yii\validators\NumberValidator;
use yii\validators\RangeValidator;
use yii\validators\RequiredValidator;


class Transaction extends ActiveRecord
{

    const TYPE_DEBIT = 0;
    const TYPE_CREDIT = 1;

    const REASON_STOCK = 0;
    const REASON_REFUND = 1;

    public static function tableName()
    {
        return '{{%transaction}}';
    }

    public function rules()
    {
        return [
            [['wallet_id', 'transaction_type', 'amount', 'currency', 'reason'], RequiredValidator::class],
            [['wallet_id', 'transaction_type', 'currency', 'reason'], NumberValidator::class, 'integerOnly' => true],
            [['amount'], NumberValidator::class],
            [['currency'], RangeValidator::class, 'range' => [Wallet::CURRENCY_RUB, Wallet::CURRENCY_USD]],
            [['transaction_type'], RangeValidator::class, 'range' => [static::TYPE_DEBIT, static::TYPE_CREDIT]],
            [['reason'], RangeValidator::class, 'range' => [static::REASON_STOCK, static::REASON_REFUND]],
        ];
    }

}
