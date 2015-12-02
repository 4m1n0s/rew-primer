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
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="css/main.css">

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div style="opacity: 1;" id="site" class="home-page">

	<header id="header" class="clearfix">
		<div class="wrap clearfix">
		<a href="#home" class="header-logo"><img class="logo left" src="images/logo.png" alt="logo Sense"></a>
		<nav id="nav" class="nav-left">
			<ul class="nav">
				<li class="active"><a class="home-page" data-page="home-page" href="#home">Welcome</a></li>
				<li class=""><a class="personalized-education" data-animatefall="true" data-direct="right" href="#personalized-education" data-page="personalized-education">Personalized Education</a></li>
				<li class=""><a class="solution-page" href="#solution-page" data-page="solution-page">Solution</a></li>
				<li class=""><a class="results-page" href="#results-page" data-page="results-page">Results</a></li>
				<li><a class="company-page" href="#company-page" data-page="company-page">Company</a></li>
			</ul>
		</nav>
		</div>
	</header>

	<div id="main-container" class="clearfix">

		<div class="pages-container" data-spy="scroll" data-target="#nav" data-offset="490">
			<div style="width: 12021px;" class="paralax-slider pages clearfix">

				<section class="container page-home blur" id="home">
					<div class="projector"></div>
					<div class="content">	  
						<h2 class="title-page">
							Making Personalized Education Scalable
						</h2>
						<p class="text-min">
							For the first time ever, educators in large-scale offline and online courses, 
							can enjoy the power of machine learning and easily provide their students with personalized feedback.
						</p>
						<?=  app\modules\subscriber\widgets\subscribeform\SubscribeFormWidget::widget() ?>			
					</div>
					<div class="mouse-container">
						<span class="mouse-icon"></span>
						<span class="txt-mouse">Scroll Down</span>
					</div>
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
						<p class="text-min txt-blue">
							The trick is to let computers do what computers do best, and let human educators do what humans do best.
						</p>						
					</div>
					<div class="gif-container left">
						<img class="img-responsive gif-img" src="images/gif/animation1-step1.gif" alt="">
						<img class="img-responsive gif-img" src="images/gif/animation1-step2.gif" alt="">
						<img class="img-responsive gif-img" src="images/gif/animation1-step3.gif" alt="">
						<img class="img-responsive mob-img" src="images/gif/img-gif.png" alt="">
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
				 <section  class="container border-triangle border-triangle-gray clearfix display-table" id="company-page">
				 	<div class="content width-title-page left-col">
						<h2 class="title-page border-bottom">
							A Sense of making <br/> a change
						</h2>
						<div class="txt-col">
							<h2 class="title-page txt-green">Our Company</h2>
							<p>Sense enables educators to evaluate open-ended assignments at scale and 
							provide personalized feedback &amp; adaptive content to their students</p>
						</div> 
					</div> <!--.left-col -->
					<div class="right-col">
						<div class="carousel-col">
							<h3 class="title-company txt-green">
								Business
							</h3>
	                        <div id="carouselv">                        	
	                            <div class="container-carousel member" data-index="0" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-8.png" alt="Ronen Tal-Botzer" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Ronen Tal-Botzer</span>
	                                	<span class="content-carousel">PhD Founder, CEO</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="1" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-7.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Yahav Dikshtein</span>
	                                	<span class="content-carousel">PhD, VP Marketing</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="2" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-9.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Tom Zohar</span>
	                                	<span class="content-carousel">Biz Dev Manager</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="3" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-8.png" alt="Ronen Tal-Botzer" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Ronen Tal-Botzer</span>
	                                	<span class="content-carousel">PhD Founder, CEO</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="4" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-7.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Yahav Dikshtein</span>
	                                	<span class="content-carousel">PhD, VP Marketing</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="5" data-popup="green-popup">
	                                <img alt="" src="images/company-foto/foto-9.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Tom Zohar</span>
	                                	<span class="content-carousel">Biz Dev Manager</span>
	                                </div>
	                            </div>
	                        </div> <!--#carouselv -->
						</div>
						<div class="carousel-col">
							<h3 class="title-company txt-blue">
								Technolog
							</h3>
	                        <div id="carouselv1">
	                            <div class="container-carousel member" data-index="0" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-5.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Shahar Ben David</span>
	                                	<span class="content-carousel">co-founders</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="1" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-6.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Gil Kotton</span>
	                                	<span class="content-carousel">Senior Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="2" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-4.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Reuven Elliassi</span>
	                                	<span class="content-carousel">Full Stack Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="3" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-5.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Shahar Ben David</span>
	                                	<span class="content-carousel">co-founders</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="4" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-6.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Gil Kotton</span>
	                                	<span class="content-carousel">Senior Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="5" data-popup="blue-popup">
	                                <img alt="" src="images/company-foto/foto-4.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Reuven Elliassi</span>
	                                	<span class="content-carousel">Full Stack Engineer</span>
	                                </div>
	                            </div>
	                        </div> <!--#carouselv1 -->
						</div>
						<div class="carousel-col">
							<h3 class="title-company txt-red">
								Science
							</h3>
	                        <div id="carouselv2">
	                            <div class="container-carousel member" data-index="0" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-3.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Lior Strauss</span>
	                                	<span class="content-carousel">PhD, co-founders</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="1" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-2.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Yaron Gonen</span>
	                                	<span class="content-carousel">PhD, Data Mining Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="2" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-1.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Ehud Hoze</span>
	                                	<span class="content-carousel">PhD, Predictions Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="3" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-3.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Lior Strauss</span>
	                                	<span class="content-carousel">PhD, co-founders</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="4" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-2.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Yaron Gonen</span>
	                                	<span class="content-carousel">PhD, Data Mining Engineer</span>
	                                </div>
	                            </div>
	                            <div class="container-carousel member" data-index="5" data-popup="red-popup">
	                                <img alt="" src="images/company-foto/foto-1.png" />
	                                <div class="txt-carousel">
	                                	<span class="title-carousel">Ehud Hoze</span>
	                                	<span class="content-carousel">PhD, Predictions Engineer</span>
	                                </div>
	                            </div>
	                        </div> <!--#carouselv2 -->
						</div>
					</div> <!--.right-col -->
					<a class="go-to-start" href="#home">Go to <br> Start</a> 
				</section>
			</div><!--end pages-->

		</div><!--end pages-container-->
		<div class="clear"></div>

	</div><!--end main-container-->


	<div style="display: block;" id="green-popup" class="team-popup bottom-popup green-bg border-triangle border-triangle-green">
		<div class="tabs">
			<div class="close"></div>
			<ul class="tabs-nav">
				<li class="active">
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-8.png" />
						<span class="title-carousel">Ronen Tal-Botzer</span>
                        <span class="content-carousel">PhD Founder, CEO</span>
					</div>
					<div class="tab-content">
						<p>
							Dr. Ronen Tal-Botzer has been a lecturer for data mining and programming 
							at Bar-Ilan University for the last 15 years. Since 2013 he is also the 
							director of the Biomedical Informatics study program at Bar-Ilan University 
							w/ Sheba Medical Center. Ronen has previously founded Correlor - a web 
							personalization company analyzing social networks, which raised a $4.2M 
							investment and now sells to big telcos.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-7.png" />
                    	<span class="title-carousel">Yahav Dikshtein</span>
                    	<span class="content-carousel">PhD, VP Marketing</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-9.png" />
                    	<span class="title-carousel">Tom Zohar</span>
                    	<span class="content-carousel">Biz Dev Manager</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-8.png" />
						<span class="title-carousel">Ronen Tal-Botzer</span>
                        <span class="content-carousel">PhD Founder, CEO</span>
					</div>
					<div class="tab-content">
						<p>
							Dr. Ronen Tal-Botzer has been a lecturer for data mining and programming 
							at Bar-Ilan University for the last 15 years. Since 2013 he is also the 
							director of the Biomedical Informatics study program at Bar-Ilan University 
							w/ Sheba Medical Center. Ronen has previously founded Correlor - a web 
							personalization company analyzing social networks, which raised a $4.2M 
							investment and now sells to big telcos.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-7.png" />
                    	<span class="title-carousel">Yahav Dikshtein</span>
                    	<span class="content-carousel">PhD, VP Marketing</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-9.png" />
                    	<span class="title-carousel">Tom Zohar</span>
                    	<span class="content-carousel">Biz Dev Manager</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div style="display: block;" id="blue-popup" class="team-popup bottom-popup blue-bg border-triangle border-triangle-blue">
		<div class="tabs">
			<div class="close"></div>
			<ul class="tabs-nav">
				<li class="active">
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-5.png" />
                    	<span class="title-carousel">Shahar Ben David</span>
                    	<span class="content-carousel">co-founders</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-6.png" />
                    	<span class="title-carousel">Gil Kotton</span>
                    	<span class="content-carousel">Senior Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-4.png" />
                    	<span class="title-carousel">Reuven Elliassi</span>
                    	<span class="content-carousel">Full Stack Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-5.png" />
                    	<span class="title-carousel">Shahar Ben David</span>
                    	<span class="content-carousel">co-founders</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-6.png" />
                    	<span class="title-carousel">Gil Kotton</span>
                    	<span class="content-carousel">Senior Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-4.png" />
                    	<span class="title-carousel">Reuven Elliassi</span>
                    	<span class="content-carousel">Full Stack Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div style="display: block;" id="red-popup" class="team-popup bottom-popup red-bg border-triangle border-triangle-red">
		<div class="tabs">
			<div class="close"></div>
			<ul class="tabs-nav">
				<li class="active">
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-3.png" />
                    	<span class="title-carousel">Lior Strauss</span>
                    	<span class="content-carousel">PhD, co-founders</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-2.png" />
                    	<span class="title-carousel">Yaron Gonen</span>
                    	<span class="content-carousel">PhD, Data Mining Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-1.png" />
                    	<span class="title-carousel">Ehud Hoze</span>
                    	<span class="content-carousel">PhD, Predictions Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-3.png" />
                    	<span class="title-carousel">Lior Strauss</span>
                    	<span class="content-carousel">PhD, co-founders</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-2.png" />
                    	<span class="title-carousel">Yaron Gonen</span>
                    	<span class="content-carousel">PhD, Data Mining Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
				<li>
					<div class="company-foto clearfix">
						<img class="left" alt="" src="images/company-foto/foto-1.png" />
                    	<span class="title-carousel">Ehud Hoze</span>
                    	<span class="content-carousel">PhD, Predictions Engineer</span>
					</div>
					<div class="tab-content">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
							fugiat nulla pariatur.
						</p> 
					</div>
				</li>
			</ul>
		</div>
	</div>

 	<div id="overlay"></div>

 </div> <!-- #site -->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/vendor.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript" src="js/full-page.min.js"></script>
<script type="text/javascript">
	fullpage.initialize('#fullpage', {
		menu: '#menu',
		css3:true
	});

</script>

<script type="text/javascript" src="js/jsCarousel-2.0.0.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#carouselv, #carouselv1, #carouselv2').jsCarousel({ autoscroll: false, masked: false, itemstodisplay: 3, orientation: 'v' });
    });       
    
</script>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
