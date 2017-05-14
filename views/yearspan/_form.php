<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Yearspan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yearspan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'yearspanid')->textInput() ?>

    <?= $form->field($model, 'year_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
