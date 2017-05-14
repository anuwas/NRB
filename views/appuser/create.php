<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Appuser */

$this->title = 'Create Appuser';
$this->params['breadcrumbs'][] = ['label' => 'Appusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
