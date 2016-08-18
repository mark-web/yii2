<?php

use yii\db\Migration;

/**
 * Handles the creation for table `author`.
 * author: (string Ф.И.О)
 */
class m180808_072634_create_author_table extends Migration
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

        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100)
        ], $tableOptions);

        // генерация строки таблицы и заполнение её
        $rows = $this->generateRows(10);
        foreach ($rows as $row) {
            $this->insert('author',$row);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('author');
    }

    /*
    * Метод, который генерирует массив данных для начального заполнения
    * таблицы.
    */
    private function generateRows($count = 0) {
        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $j = $i + 1;
            $rows[$i] = [
                'id' => $j,
                'fio'     => " author fio " . $j
            ];
        }
        return $rows;
    }
}
