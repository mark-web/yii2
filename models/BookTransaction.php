<?php

namespace app\models;

use Yii;

class BookTransaction extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'book_transaction';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'                  => 'ID статуса',
            'book'                => 'ID книги',
            'client'              => 'ID клиента',
            'bookTransactionType' => 'Тип транзакции',
            'dateTimeTransaction' => 'Дата-время операции',
        ];
    }
}