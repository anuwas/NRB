<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Yearspan */

$this->title = 'Create Yearspan';
$this->params['breadcrumbs'][] = ['label' => 'Yearspans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yearspan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
