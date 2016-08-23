<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\LoginFormAsset;

LoginFormAsset::register($this);

$this->title = 'Регистрация/авторизация ользователей, AngularJS';
?>
<div class="main-block" ng-controller="appCtrl">
    <ng-include src="'/site/auth-form'" ng-show="currentView == 'auth'"></ng-include>
    <ng-include src="'/site/register-form'" ng-show="currentView == 'registration'"></ng-include>
</div>
