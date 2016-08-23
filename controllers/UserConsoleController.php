<?php

namespace app\controllers;

use Yii;
use app\controllers\MainController;

class UserConsoleController extends MainController {

    /*
     * Метод по умолчанию.
     */
    public function actionIndex() {

        return $this->render('index', []);
    }

    /*
     * Шаблон таблицы пользователей
     */
    public function actionGetUserTable() {

        return $this->render('user_table', []);
    }

    /*
     * Шаблон добавления пользователя
     */
    public function actionGetAddUser() {

        return $this->render('add_user', []);
    }

    /*
     * Шаблон добавления пользователя
     */
    public function actionGetDefaultUsers() {

        return '
            [
             {"name":"Sergey","surname":"Testov","age":"26"},
             {"name":"Irina","surname":"Testova","age":"25"},
             {"name":"Aleks","surname":"Testov","age":"3"},
             {"name":"John","surname":"Testov","age":"12"},
             {"name":"Angela","surname":"Testova","age":"33"}
           ]';
    }
}