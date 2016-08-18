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
use yii\web\Response;
use yii\filters\ContentNegotiator;

class BookController extends Controller {

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
                ],
                'except' => ['index']
            ]
        ];
    }

    /*
     * Метод по умолчанию. Выводит таблицу книг.
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
                    'book_status' => [
                    ],
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
            ]
        );
    }

    /*
     * Метод для поиска.
     */
    public function actionSearch() {
        Yii::$app->response->format = 'json';
        $model = new Books();
       // if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post();

            if (isset($post['bookName'])) {

                return ['data' => $model->getByName($post['bookName'])];
            }
       // }

        return ['data' => false];
    }

}