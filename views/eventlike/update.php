<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventlike */

$this->title = 'Update Eventlike: ' . $model->eventlikeid;
$this->params['breadcrumbs'][] = ['label' => 'Eventlikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eventlikeid, 'url' => ['view', 'id' => $model->eventlikeid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eventlike-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
