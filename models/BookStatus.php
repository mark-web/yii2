<?php
namespace app\models;

use Yii;

class BookStatus extends \yii\db\ActiveRecord
{
    /**
     * Таблица БД.
     */
    public static function tableName()
    {
        return 'book_status';
    }

    /**
     * Метки атрибутов.
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID статуса',
            'name' => 'Название статуса'
        ];
    }
}
