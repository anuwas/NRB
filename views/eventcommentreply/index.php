<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventcommentreplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventcommentreplies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventcommentreply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eventcommentreply', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eventcommentreplyid',
            'eventcommentid',
            'appuserid',
            'eventid',
            'comment:ntext',
            // 'created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
