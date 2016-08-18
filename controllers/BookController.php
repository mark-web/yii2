<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Books;
use app\models\Author;
use app\models\BookStatus;
use app\models\BookTransaction;
use app\models\BookTransactionType;
use app\models\Client;
use app\models\Location;
use yii\data\ActiveDataProvider;

class BookController extends Controller {

    /*
     * Метод по умолчанию. Выводит таблицу сообщений.
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find(),
            'pagination' => [
                'pagesize' => 25,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_date' => SORT_ASC,
                ],
                'attributes' => [
                    'name' => [
                    ],
                    'location_id' => [
                    ],
                    'create_date' => [
                    ],
                    'bookStatus' => [
                    ],
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
            ]
        );
    }

}