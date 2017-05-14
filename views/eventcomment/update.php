<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventcomment */

$this->title = 'Update Eventcomment: ' . $model->eventcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Eventcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eventcommentid, 'url' => ['view', 'id' => $model->eventcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eventcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
