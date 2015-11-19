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


<html class="no-js" lang="<?= Yii::$app->language ?>">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="css/main.css">

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


    <!--
<?=  app\modules\subscriber\widgets\subscribeform\SubscribeFormWidget::widget() ?>
-->

<div style="opacity: 1;" id="site" class="home_page">

	<header id="header" class="clearfix">
		<div class="wrap clearfix">
		<img class="logo left" src="images/logo.png" alt="logo Sense">
		<nav id="nav" class="right">
			<ul class="nav">
				<li class="active"><a class="home_page" data-page="home_page" href="#home">Welcome</a></li>
				<li class=""><a class="personalized-education" href="#personalized-education" data-page="personalized-education">Personalized Education</a></li>
				<li class=""><a class="solution-page" href="#solution-page" data-page="solution-page">Solution</a></li>
				<li class=""><a class="results-page" href="#results-page" data-page="results-page">Results</a></li>
				<li><a class="company-page" href="#company-page" data-page="company-page">Company</a></li>
			</ul>
		</nav>
		</div>
	</header>

	<div id="main_container" class="clearfix">

		<div class="pages_container" data-spy="scroll" data-target="#nav" data-offset="490">
			<div style="width: 12021px;" class="paralax-slider pages clearfix">

				<section class="container page_home blur" id="home">
					<div class="projector"></div>
					<div class="content">	  
						<h2 class="title-page">
							Making Personalized Education Scalable
						</h2>
						<p class="text-home-min">
							For the first time ever, educators in large-scale offline and online courses, 
							can enjoy the power of machine learning and easily provide their students with personalized feedback.
						</p>
					</div>
					<div class="mouse_icon">Scroll Down</div>
				</section>

				<section class="container border-triangle border-triangle-blue-img" id="personalized-education">
					<div class="sheets-bg">
						<img src="images/informal-bg-top.png" alt="">
					</div>
					<div class="content">
					</div>
				</section>

				<section class="container border-triangle border-triangle-gray" id="solution-page">
					<div class="content">
						<!-- <div id="team_container">
							<ul>
								<li class="member" data-index="0" data-popup="team_popup" style="margin-left:30px;margin-top:-54px; z-index:2">
								<div class="member_info border_left" style="left:167px; top:115px; width:240px; height:100px; text-align:left">
								<div class="plus_sign bottom left"></div><p class="short_bio"></p></div>
								</li>
							</ul>
						</div> -->
					</div>
				</section>
				<section class="container border-triangle border-triangle-green" id="results-page">
					<div class="content">
					</div>
				 </section>
				 <section  class="container border-triangle border-triangle-gray" id="company-page">
				 	<div class="content">
					</div>
				</section>
			</div><!--end pages-->

		</div><!--end pages_container-->
		<div class="clear"></div>


	</div><!--end main_container-->


	<div style="display: block;" id="team_popup" class="team_popup bottom_popup">
		<div class="popup_close"></div>
		<div class="modal-content">asdfasdf</div>
	</div>

 	<div id="overlay"></div>

 </div> <!-- #site -->

<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#home').parallax("50%", 0);
		$('#personalized-education').parallax("50%", 0);

		$('#personalized-education .sheets-bg img').parallax("50%", 0); // будет двигаться по скролу мыши до right: -30%;

		$('#solution-page').parallax("50%", 0);
		$('#results-page').parallax("50%", 0);
		$('#company-page').parallax("50%", 0);
		
	})
</script>

 <script src="js/vendor.js"></script><!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
 <script>
 (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-49908940-4');ga('send','pageview');
</script>
<script src="js/main.js"></script>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
