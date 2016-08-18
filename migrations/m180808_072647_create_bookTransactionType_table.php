<?php

use yii\db\Migration;
use app\models\BookTransactionType;

/**
 * Handles the creation for table `booktransactiontype`.
 * bookTransactionType: (выдана, возвращена, потеряна)
 */
class m180808_072647_create_bookTransactionType_table extends Migration
{
    private $default_values = ['выдана', 'возвращена', 'потеряна'];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('book_transaction_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(10)
        ], $tableOptions);

        // генерация строки таблицы и заполнение её
        $rows = $this->generateRows();
        foreach ($rows as $row) {
            $this->insert('book_transaction_type',$row);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book_transaction_type');
    }

    /*
         * Метод, который генерирует массив данных для начального заполнения
         * таблицы.
         */
    private function generateRows() {
        $rows = [];
        $i=0;
        foreach ($this->default_values as $key => $value) {
            $rows[$i++] = [
                'id'   => $i,
                'name' => $value
            ];
        }
        return $rows;
    }
}
