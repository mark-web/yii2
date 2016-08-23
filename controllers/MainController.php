<?php

namespace app\controllers;

use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\base\UserException;

abstract class MainController extends Controller
{
    // Шаблон вывода
    public $layout;

    // Title
    public $title;

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
            ]/*,//TODO:реализовать
            'authorizeControl' => [
                'class' => 'app\components\AuthorizeControl',
                'except' => ['error', 'logout']
            ]*/
        ];
    }


    /**
     * Actions
     *
     * @return array - actions
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }


    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        if (!$result = parent::beforeAction($action)) {
            return $result;
        }

        return $result;
    }
}
