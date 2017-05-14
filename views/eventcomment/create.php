<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Eventcomment */

$this->title = 'Create Eventcomment';
$this->params['breadcrumbs'][] = ['label' => 'Eventcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
