<?php

namespace app\models;

use Yii;

class Author extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID автора',
            'name'        => 'ФИО автора'
        ];
    }
}
