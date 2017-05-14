<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Yearspan */

$this->title = 'Update Yearspan: ' . $model->yearspanid;
$this->params['breadcrumbs'][] = ['label' => 'Yearspans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->yearspanid, 'url' => ['view', 'id' => $model->yearspanid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yearspan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
