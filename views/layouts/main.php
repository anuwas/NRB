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
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/calendar/bootstrap_calendar.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/app.css" type="text/css" />
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/jquery.min.js"></script>
  <!--[if lt IE 9]>
    <script src="js/ie/respond.min.js" cache="false"></script>
    <script src="js/ie/html5.js" cache="false"></script>
    <script src="js/ie/fix.js" cache="false"></script>
  <![endif]-->
  <style type="text/css">
  .circle1 {
   	width: 20px;
    height: 20px;
    background: red;
    border-radius: 50%;
    display: inline-block;
    margin-left: 3px;
    position: relative;
    text-align: center;
    color: white;
  </style>
</head>
<body>
<?php $this->beginBody() ?>
<?php 
$session = Yii::$app->session;
if($session->get('loggeduser')!=null || $session->get('loggeduser')!=''){
?>
  <section class="hbox stretch">
    <!-- .aside -->
    <aside class="bg-primary aside-sm" id="nav">
      <section class="vbox">
        <header class="dker nav-bar nav-bar-fixed-top">
          <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
            <i class="fa fa-bars"></i>
          </a>
          <a href="#" class="nav-brand" data-toggle="fullscreen">NRB</a>
          <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user">
            <i class="fa fa-comment-o"></i>
          </a>
        </header>
        <section>
          <!-- user -->
          <div class="bg-success nav-user hidden-xs pos-rlt">
            <div class="nav-avatar pos-rlt">
              <a href="#" class="thumb-sm avatar animated rollIn" data-toggle="dropdown">
                <img src="<?php echo Yii::getAlias('@web').'/web/assets/'?>images/avatar.jpg" alt="" class="">
                <span class="caret caret-white"></span>
              </a>
              <ul class="dropdown-menu m-t-sm animated fadeInLeft">
              	<span class="arrow top"></span>
                <li>
                  <a href="profile">Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="index/logout">Logout</a>
                </li>
              </ul>
              <div class="visible-xs m-t m-b">
                <a href="#" class="h3">John.Smith</a>
                <p><i class="fa fa-map-marker"></i> London, UK</p>
              </div>
            </div>
            
          </div>
          <!-- / user -->
          <!-- nav -->
          <nav class="nav-primary hidden-xs">
            <ul class="nav">
              <li class="active">
                <a href="home">
                  <i class="fa fa-eye"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li>
                <a href="events">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <span>Events</span>
                </a>
              </li>
              <li>
                <a href="comments">
                  <i class="fa fa-comment" aria-hidden="true"></i>
                  <span>Comments</span>
                  <div class="circle1" id="commentwarning" style="display: none;"></div>
                </a>
              </li>
              <li>
                <a href="users">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <span>All User</span>
                </a>
              </li>
              <li>
                <a href="netaji-gallery">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <span>Gallery</span>
                </a>
              </li>
              <li>
                <a href="feature-gallery">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <span>Feature Gallery</span>
                </a>
              </li>
              <li>
                <a href="year-span">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <span>Year Span</span>
                </a>
              </li>
               <li>
                <a href="contact-us">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>ContactUs</span>
                </a>
              </li>
              
            </ul>
          </nav>
          <!-- / nav -->
          <!-- note -->
          <div class="bg-danger wrapper hidden-vertical animated fadeInUp text-sm">            
              <a href="#" data-dismiss="alert" class="pull-right m-r-n-sm m-t-n-sm"><i class="fa fa-times"></i></a>
              Hi, welcome to NRB,  you can start here.
          </div>
          <!-- / note -->
        </section>
        <footer class="footer bg-gradient hidden-xs">
          <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right">
            <i class="fa fa-power-off"></i>
          </a>
          <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm">
            <i class="fa fa-bars"></i>
          </a>
        </footer>
      </section>
    </aside>
    <?php } ?>
    <!-- /.aside -->
    <!-- .vbox -->
<?= $content ?>
    <!-- /.vbox -->
  </section>
	
  <!-- Bootstrap -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/bootstrap.js"></script>
  <!-- Sparkline Chart -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/charts/sparkline/jquery.sparkline.min.js"></script>
  <!-- App -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.js"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.plugin.js"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/app.data.js"></script>  
    <!-- Calendar -->
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/calendar/bootstrap_calendar.js" cache="false"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/calendar/demo.js" cache="false"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/libs/jquery.pjax.js" cache="false"></script>
  <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/nrbinner_jq.js" cache="false"></script>
  <script type="text/javascript">
  $(document).ready(function(){
	  $.ajax({
	       url: '<?php echo Yii::$app->request->baseUrl. '/index/totalunpublishcomment' ?>',
	       type: 'post',
	       data: {
	                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
	             },
	       success: function (data) {
	          if(data>0){
	        	  $("#commentwarning").show();
	        	  $("#commentwarning").html(data);
	          }else{
	        	  $("#commentwarning").hide();
	          }
	       }
	  });
  });
  </script>
</body>
</html>