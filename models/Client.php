<?php

namespace app\models;

use Yii;

class Client extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID клиента',
            'fio' => 'ФИО клиента',
            'gender' => 'пол'
        ];
    }
}