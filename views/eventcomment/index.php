<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventcomments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eventcomment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eventcommentid',
            'appuserid',
            'eventid',
            'comment:ntext',
            'commentdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
