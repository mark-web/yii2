<?php

namespace app\models;

use Yii;

class Books extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Название книги',
            'description' => 'Описание книги',
            'location_id' => 'ID расположения',
            'bookStatus'  => 'ID статуса кники',
            'create_date' => 'дата создания',
            'uprate_date' => 'дата изменения'
        ];
    }
}