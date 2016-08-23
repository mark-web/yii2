<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\UserConsoleAsset;

UserConsoleAsset::register($this);

$this->title = 'Консоль пользователей AngularJS';
?>
<div class="col-md-12">
    <div class="container" ng-controller="appCtrl">
        <div class="panel panel-default">
            <div class="panel-heading">Список пользователей AngularJs</div>
            <ng-include src="'/user-console/get-user-table'" ng-show = "currentView == 'userTable'"></ng-include>
            <ng-include src="'/user-console/get-add-user'" ng-show = "currentView == 'addUser'"></ng-include>
        </div>
    </div>
</div>
