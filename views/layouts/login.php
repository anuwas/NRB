<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Web Application | NRB</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/respond.min.js" cache="false"></script>
    <script src="js/ie/html5.js" cache="false"></script>
    <script src="js/ie/fix.js" cache="false"></script>
  <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>NRB<br>&copy; 2016</small>
      </p>
    </div>
  </footer>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/bootstrap.js"></script>
  <!-- app -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.js"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.plugin.js"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.data.js"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/login.js"></script>
</body>
</html>
