<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventlikeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventlike-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eventlikeid') ?>

    <?= $form->field($model, 'eventid') ?>

    <?= $form->field($model, 'appuserid') ?>

    <?= $form->field($model, 'eventlikedate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
