<?php

use yii\db\Migration;
use app\models\BookStatus;

/**
 * Handles the creation for table `bookstatus`.
 * bookStatus: (В наличии, выдана на руки, списана) - статус книги
 */
class m180808_072553_create_bookStatus_table extends Migration
{
    private $default_values = ['списана', 'в наличии', 'выдана на руки'];
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('book_status', [
            'id'   => $this->primaryKey(),
            'name' => $this->string(20)->notNull()
        ], $tableOptions);

        // генерация строки таблицы и заполнение её
        $rows = $this->generateRows();
        foreach ($rows as $row) {
            $this->insert('book_status',$row);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book_status');
    }

    /*
         * Метод, который генерирует массив данных для начального заполнения
         * таблицы.
         */
    private function generateRows() {
        $rows = [];
        $i = 0;
        foreach ($this->default_values as $key => $value) {
            $rows[$i++] = [
                'id'   => $i,
                'name' => $value
            ];
        }
        return $rows;
    }
}
