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
     * Правила валидации.
     */
    public function rules()
    {
        Yii::$app->language = 'ru-RU';

        $rules = [
            ['name', 'match', 'pattern' => '/^[a-z0-9]{3,16}$/i',
                'message' => 'Название книги должно содержать только цифры и буквы латинского алфавита.'],
            ['name', 'string', 'length' => [3, 18]],
        ];
        return array_merge(parent::rules(),$rules);
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
            'book_status'  => 'ID статуса кники',
            'create_date' => 'дата создания',
            'uprate_date' => 'дата изменения'
        ];
    }

    /**
     * Поолучение основной новости
     *
     * @return array
     */
    public function getByName($name)
    {
        return $this::find()
            ->andFilterWhere(['like', 'name', $name])
            ->all();
    }
}