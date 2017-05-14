<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appuser */

$this->title = 'Update Appuser: ' . $model->appuserid;
$this->params['breadcrumbs'][] = ['label' => 'Appusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->appuserid, 'url' => ['view', 'id' => $model->appuserid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
