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

<div style="opacity: 1;" id="site" class="home_page">

	<header id="header" class="clearfix">
		<div class="wrap clearfix">
		<img class="logo left" src="images/logo.png" alt="logo Sense">
		<nav id="nav" class="right">
			<ul class="nav">
				<li class="active"><a class="home_page" data-page="home_page" href="#home">Welcome</a></li>
				<li class=""><a class="personalized-education" data-animatefall="true" data-direct="right" href="#personalized-education" data-page="personalized-education">Personalized Education</a></li>
				<li class=""><a class="solution-page" href="#solution-page" data-page="solution-page">Solution</a></li>
				<li class=""><a class="results-page" href="#results-page" data-page="results-page">Results</a></li>
				<li><a class="company-page" href="#company-page" data-page="company-page">Company</a></li>
			</ul>
		</nav>
		</div>
	</header>

	<div id="main-container" class="clearfix">

		<div class="pages_container" data-spy="scroll" data-target="#nav" data-offset="490">
			<div style="width: 12021px;" class="paralax-slider pages clearfix">

				<section class="container page-home blur" id="home">
					<div class="projector"></div>
					<div class="content">	  
						<h2 class="title-page">
							Making Personalized Education Scalable
						</h2>
						<p class="text-home-min">
							For the first time ever, educators in large-scale offline and online courses, 
							can enjoy the power of machine learning and easily provide their students with personalized feedback.
						</p>
						<?=  app\modules\subscriber\widgets\subscribeform\SubscribeFormWidget::widget() ?>			
					</div>
					<div class="mouse-icon">Scroll Down</div>
				</section>

				<section class="container personalized-container border-triangle border-triangle-blue-img" id="personalized-education">
					<div class="sheets-bg">
						<img data-endpos="left" src="images/informal-bg-top.png" alt="">
					</div>
					<div class="content">
						<div class="col-height">
							<h3>What Educators like?</h3>
							<p>Building amazing learning experiences where each student receives just the right feedback 
							targeted specifically to his/her own needs.</p>
						</div>
						<div class="col-height">
							<h3>What Educators dislike?</h3>
							<p>Endlessly evaluating piles of open-ended assignments</p>
						</div>
						<div class="col-height">
							<h3>Can artificial intelligence and auto-grading evaluate open-ended assignments as</h3>
							<p>The simple answer is… No.</p>
						</div>	
						<div class="btn-block-popup">
							<button class="btn btn-blue btn-learn-more" type="submit">Learn More</button>
							<div class="txt-lear-more blue-bg">
								<button aria-label="close" data-dismiss="Learn More" class="close-popup" type="button">
                    			</button>
                    			<p>Open-ended assignments are the best, and many times the only, way of learning STEM 
                    			(Science, Technology, Engineering and Math).</p>
                    			<p>Today’s larger and larger offline and online courses are in desperate seek of a 
                    			scalable solution to evaluate open-ended assignments and provide students with personalized feedback.</p>
							</div>
						</div>
					</div>
				</section>

				<section class="container border-triangle border-triangle-gray" id="solution-page">
				
					<div class="content left width-title-page">
						<h2 class="title-page">
							Sense’s Hybrid Solution
						</h2>
						<ol class="counter-reset">
							<li>Computers detect the similarities that are naturally shared among students’ submissions.</li>
							<li>Submissions are clustered into 5-10 major solution types. Sense then produces a summary on each solution type.</li>
							<li>The educator evaluates and provides feedback to each solution type, rather than to each submission in separate.</li>
						</ol>
						<p class="text-home-min txt-blue">
							The trick is to let computers do what computers do best, and let human educators do what humans do best.
						</p>						
					</div>
					<div class="gif-container left">
						<img class="img-responsive" src="images/gif/animation1-step1.gif" alt="">
						<img class="img-responsive" src="images/gif/animation1-step2.gif" alt="">
						<img class="img-responsive" src="images/gif/animation1-step3.gif" alt="">
					</div>
				</section>
				<section class="container border-triangle border-triangle-green" id="results-page">
					<div id="fullpage">
						<div class="section" id="section0">
							<div class="slide">
								<div class="content width-title-page">
									<h2 class="title-page">
										Sense is making <br/> a mark everyday
									</h2>
								</div>
							</div>
							<div class="slide">
								<div class="content width-title-page">
									<h2 class="title-page">
										Sense is making <br/> a mark everyday 2
									</h2>
								</div>
							</div>
							<div class="slide">
								<div class="content width-title-page">
									<h2 class="title-page">
										Sense is making <br/> a mark everyday 3
									</h2>
								</div>
							</div>
						</div>
					</div> <!-- //#fullpage -->
				 </section>
				 <section  class="container border-triangle border-triangle-gray" id="company-page">
				 	<div class="content width-title-page">
						<h2 class="title-page">
							A Sense of making <br/> a change
						</h2>
						<!-- <div id="team_container">
							<ul>
								<li class="member" data-index="0" data-popup="team_popup" style="margin-left:30px;margin-top:-54px; z-index:2">
								<div class="member_info border_left" style="left:167px; top:115px; width:240px; height:100px; text-align:left">
								<div class="plus_sign bottom left"></div><p class="short_bio"></p></div>
								</li>
							</ul>
						</div> -->
					</div>
					<a class="go-to-start" href="#home">Go to <br> Start</a> 
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

<script type="text/javascript" src="js/jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/vendor.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript" src="js/full-page.min.js"></script>
<script type="text/javascript">
	fullpage.initialize('#fullpage', {
		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
		menu: '#menu',
		css3:true
	});

</script>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
