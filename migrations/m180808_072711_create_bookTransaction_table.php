<?php

use yii\db\Migration;

/**
 * Handles the creation for table `booktransaction`.
 * bookTransaction(book книга, client Клиент, bookTransactionType тип транзакции, дата+время операции)
 */
class m180808_072711_create_bookTransaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('book_transaction', [
            'id' => $this->primaryKey(),
            'book' => $this->integer(),
            'client' => $this->integer(),
            'bookTransactionType' => $this->integer(),
            'dateTimeTransaction' => $this->dateTime(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book_transaction');
    }
}
