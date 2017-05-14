<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Appuser */

$this->title = $model->appuserid;
$this->params['breadcrumbs'][] = ['label' => 'Appusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->appuserid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->appuserid], [
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
            'appuserid',
            'username',
            'email:email',
            'phone',
            'password',
            'status',
            'create_date',
        ],
    ]) ?>

</div>
