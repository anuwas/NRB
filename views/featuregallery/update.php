<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Featuregallery */

$this->title = 'Update Featuregallery: ' . $model->featuregallery_id;
$this->params['breadcrumbs'][] = ['label' => 'Featuregalleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->featuregallery_id, 'url' => ['view', 'id' => $model->featuregallery_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="featuregallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
