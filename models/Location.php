<?php

namespace app\models;

use Yii;

class Location extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID расположения',
            'hall'     => 'зал',
            'stillage' => 'стелаж',
            'rack'     => 'полка',
            'position' => 'позиция'
        ];
    }
}