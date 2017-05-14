<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Eventlike */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventlike-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'eventid')->textInput() ?>

    <?= $form->field($model, 'appuserid')->textInput() ?>

    <?= $form->field($model, 'eventlikedate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
