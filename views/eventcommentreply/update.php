<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventcommentreply */

$this->title = 'Update Eventcommentreply: ' . $model->eventcommentreplyid;
$this->params['breadcrumbs'][] = ['label' => 'Eventcommentreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eventcommentreplyid, 'url' => ['view', 'id' => $model->eventcommentreplyid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eventcommentreply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
