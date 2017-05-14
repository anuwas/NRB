<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contactus */

$this->title = $model->contactusid;
$this->params['breadcrumbs'][] = ['label' => 'Contactuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->contactusid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->contactusid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'contactusid',
            'fullname',
            'emailid:email',
            'phone_number',
            'contat_message:ntext',
            'created_date',
        ],
    ]) ?>

</div>
