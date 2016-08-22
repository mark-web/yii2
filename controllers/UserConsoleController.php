<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class UserConsoleController extends Controller {

    /**
     * Поведения
     *
     * @return array - Поведения
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'text/html' => Response::FORMAT_HTML
                ]
            ]
        ];
    }

    /*
     * Метод по умолчанию.
     */
    public function actionIndex() {

        return $this->render('index', ['data' => '
            [
             {"name":"Sergey","surname":"Testov","age":"26"},
             {"name":"Irina","surname":"Testova","age":"25"},
             {"name":"Aleks","surname":"Testov","age":"3"}
           ]'
        ]);
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
             {"name":"Aleks","surname":"Testov","age":"3"}
           ]';
    }
}