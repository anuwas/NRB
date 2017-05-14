<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Eventcomment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventcomment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'appuserid')->textInput() ?>

    <?= $form->field($model, 'eventid')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'commentdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
