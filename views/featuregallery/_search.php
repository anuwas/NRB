<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeaturegallerySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="featuregallery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'featuregallery_id') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'image_title') ?>

    <?= $form->field($model, 'image_alt') ?>

    <?= $form->field($model, 'created_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
