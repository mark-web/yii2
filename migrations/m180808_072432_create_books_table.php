<?php

use yii\db\Migration;
use app\models\Books;

/**
 * Handles the creation for table `books`.
 * book: (string название,
 *        string описание,
 *        location расположение,
 *        date дата добавления,
 *        bookStatus - статус книги) - Информация про книги
 */
class m180808_072432_create_books_table extends Migration
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

        $this->createTable('books', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'location_id' => $this->integer(10)->defaultValue(0),
            'book_status'  => $this->integer(10)->defaultValue(1),
            'create_date' => $this->dateTime()->notNull(),
            'uprate_date' => $this->dateTime()->null()
        ], $tableOptions);

        //создание индекса
        //$this->createIndex('idx-book_status', 'books', 'book_status');

        // генерация строки таблицы и заполнение её
        $rows = $this->generateRows(35);
        foreach ($rows as $row) {
            $this->insert('books',$row);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('books');
    }

    /*
     * Метод, который генерирует массив данных для начального заполнения
     * таблицы.
     */
    private function generateRows($count = 0) {
        $rows = [];
        $dt = new \DateTime();
        for ($i = 0; $i < $count; $i++) {
            $j = $i + 1;
            $rows[$i] = [
                'id'          => $j,
                'name'        => " book name " . $j,
                'description' => " book description " . $j,
                'location_id' =>  $j%3,
                'book_status'  =>  1,
                'create_date' => $dt->format('Y-m-d H:i:s')
            ];
            $dt = $dt->modify('+1 second');
        }
        return $rows;
    }
}