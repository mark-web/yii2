<?php

use yii\db\Migration;

/**
 * Handles the creation for table `client`.
 * client:(string ФИО, enum('M','F') Пол клиента) - клиенты
 */
class m180808_072658_create_client_table extends Migration
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

        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100),
            'gender' => $this->string(2),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client');
    }
}
