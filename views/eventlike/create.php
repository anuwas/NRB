<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Eventlike */

$this->title = 'Create Eventlike';
$this->params['breadcrumbs'][] = ['label' => 'Eventlikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventlike-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
