<?php

use yii\db\Migration;

/**
 * Handles the creation for table `location`.
 * location: (string зал, string стелаж, string полка, string позиция) - месторасположение книги
 */
class m180808_072609_create_location_table extends Migration
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

        $this->createTable('location', [
            'id'       => $this->primaryKey(),
            'hall'     => $this->string(50),
            'stillage' => $this->string(50),
            'rack'     => $this->string(50),
            'position' => $this->string(50)
        ], $tableOptions);

        // генерация строки таблицы и заполнение её
        $rows = $this->generateRows(10);
        foreach ($rows as $row) {
            $this->insert('location',$row);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('location');
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
                'hall'     => " hall " . $j,
                'stillage' => " stillage " . $j%3,
                'rack'     => " rack " . $j%2,
                'position' => " position " . $j%5
            ];
        }
        return $rows;
    }
}
