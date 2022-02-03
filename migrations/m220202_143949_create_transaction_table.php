<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction}}`.
 */
class m220202_143949_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'wallet_id' => $this->integer(11)->notNull()->comment('Wallet ID'),
            'transaction_type' => $this->tinyInteger(1)->notNull()->comment('Transaction type. 0 - Debit, 1 - Credit'),
            'original_amount' => $this->float(9,2)->notNull()->comment('Original transaction amount'),
            'currency' => $this->tinyInteger(1)->notNull()->comment('Transaction currency. 0 - RUB, 1 - USD'),
            'converted_amount' => $this->float(9,2)->notNull()->comment('Converted transaction amount'),
            'reason' => $this->tinyInteger(1)->notNull()->comment('Transaction reason. 0 - stock, 1 - refund, ...'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Transaction creation date/time'),
        ]);

        $this->addForeignKey('transaction_wallet_id-wallet_id', '{{%transaction}}', 'wallet_id', '{{%wallet}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('transaction_wallet_id-wallet_id', '{{%transaction}}');

        $this->dropTable('{{%transaction}}');
    }
}
