<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Eventlike */

$this->title = $model->eventlikeid;
$this->params['breadcrumbs'][] = ['label' => 'Eventlikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventlike-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->eventlikeid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->eventlikeid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eventlikeid',
            'eventid',
            'appuserid',
            'eventlikedate',
        ],
    ]) ?>

</div>
