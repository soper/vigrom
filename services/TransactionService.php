<?php

namespace app\services;

use app\models\Transaction;
use yii\base\Model;
use app\models\Wallet;
use yii\validators\NumberValidator;
use yii\validators\RangeValidator;
use yii\validators\RequiredValidator;

class TransactionService extends Model
{

    public $wallet_id;
    public $transaction_type;
    public $amount;
    public $currency;
    public $reason;

    public $message;


    public function rules()
    {
        return [
            [['wallet_id', 'transaction_type', 'amount', 'currency', 'reason'], RequiredValidator::class],
            [['wallet_id', 'transaction_type', 'currency', 'reason'], NumberValidator::class, 'integerOnly' => true],
            [['amount'], NumberValidator::class],
            [['currency'], RangeValidator::class, 'range' => [Wallet::CURRENCY_RUB, Wallet::CURRENCY_USD]],
            [['transaction_type'], RangeValidator::class, 'range' => [Transaction::TYPE_DEBIT, Transaction::TYPE_CREDIT]],
            [['reason'], RangeValidator::class, 'range' => [Transaction::REASON_STOCK, Transaction::REASON_REFUND]],
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * Process transaction
     *
     * @param Wallet $wallet
     * @param array $params
     * @return bool
     */
    public function processTransaction(Wallet $wallet, array $params): bool
    {
        $this->wallet_id = $wallet->id;

        if ($this->load($params) && $this->validate()) {

            $converted_amount = $this->convertAmount($wallet);

            if ($this->transaction_type == Transaction::TYPE_CREDIT) {
                $converted_amount = $converted_amount * (-1);
            }



            $wallet->amount += $converted_amount;

            if ($wallet->save()) {

                unset($params['amount']);

                $transaction = new Transaction($params);
                $transaction->wallet_id = $wallet->id;
                $transaction->original_amount = $this->amount;
                $transaction->converted_amount = $converted_amount;
                $transaction->save();

                return true;
            }
            else {
                $this->message = "Can't save wallet";
            }

        }
        else {
            $this->message = "Didn't validate";
        }

        return false;
    }

    /**
     * Convert amount, based on Wallet currency
     *
     * @param Wallet $wallet
     */
    public function convertAmount(Wallet $wallet): float
    {
        $converted_amount = $this->amount;
        if ($this->currency != $wallet->currency) {
            $rate = $this->getConversionRate();
            $converted_amount = $this->amount * $rate;
        }
        return $converted_amount;
    }

    /**
     * Get current conversion rate for currency
     *
     * @return float
     */
    public function getConversionRate()
    {
        /// заглушка, в действительности тут должно быть обращение к скрвису получения текущего курса рубля по
        ///  отношению к доллару
        $rate = 76.48;

        if ($this->currency == Wallet::CURRENCY_RUB) {
            $rate = 1 / $rate;
        }

        return $rate;
    }

}
