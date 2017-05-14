<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DBUser */
/* @var $form yii\widgets\ActiveForm */
?>

<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <a class="nav-brand" href="index.html">NRB</a>
    <div class="row m-n">
      <div class="col-md-4 col-md-offset-4 m-t-lg">
        <section class="panel">
          <header class="panel-heading text-center">
            Sign in
          </header>
    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'class' => 'panel-body',
            		'id'=>'login_form'
             ]
        ]); ?>

    <div class="form-group">
              <label class="control-label">User Name</label>
              <input type="email" placeholder="test@example.com" class="form-control" id="dbuser-email"  name="DBUser[email]">
              <div id="email_msg" style="color: red;display: none"></div>
            </div>
    <div class="form-group">
              <label class="control-label">Password</label>
              <input type="password" id="dbuser-password"  name="DBUser[password]" placeholder="Password" class="form-control">
           		<div id="passwprd_msg" style="color: red;display: none"></div>
            </div>

   <button type="submit" class="btn btn-info">Sign in</button>
   <span style="color: red"><?php echo $message;?></span>
<div class="line line-dashed"></div>
    <?php ActiveForm::end(); ?>
</section>
			
            
           
            
            
