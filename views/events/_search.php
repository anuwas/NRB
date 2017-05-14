<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eventid') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'event_name') ?>

    <?= $form->field($model, 'event_date') ?>

    <?= $form->field($model, 'event_image') ?>

    <?php // echo $form->field($model, 'event_status') ?>

    <?php // echo $form->field($model, 'event_created_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
