<?php

namespace app\models;

use Yii;

class BookTransactionType extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'book_transaction_type';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID транзакции',
            'fio' => 'ФИО клиента',
            'gender' => 'пол'
        ];
    }
}
