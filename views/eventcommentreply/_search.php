<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventcommentreplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventcommentreply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eventcommentreplyid') ?>

    <?= $form->field($model, 'eventcommentid') ?>

    <?= $form->field($model, 'appuserid') ?>

    <?= $form->field($model, 'eventid') ?>

    <?= $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
