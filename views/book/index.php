<?php
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\SearchFormAsset;

SearchFormAsset::register($this);

$this->title = 'Информация про книги';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Поиск по названию книги" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary" id="quick_search_btn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}{pager}",
    'columns' => [
        'id',
        'name',
        'description',
        'location_id',
        'book_status',
        'create_date',
    ],
]); ?>