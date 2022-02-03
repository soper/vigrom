<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wallet}}`.
 */
class m220202_143745_create_wallet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wallet}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull()->unique()->comment('User ID'),
            'amount' => $this->float(9,2)->notNull()->comment('Wallet amount'),
            'currency' => $this->tinyInteger(1)->notNull()->comment('Wallet currency. 0 - RUB, 1 - USD'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wallet}}');
    }
}
