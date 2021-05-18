<?php
include("snake.php");
session_start();
include("functions.php");
if(isset($_SESSION["@snake_id"])){
  $qri = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
  $qri->execute([$_SESSION["@snake_id"]]);
  if($qri->rowCount() != 1){
    header('location: ./logout');
  }else{
    null;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:20:43 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vetogra</title>
		<!-- Favicone Icon -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,800%7CLato:300,400,700" rel="stylesheet" type="text/css">
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">


    <link href="assets/css/all.css" rel="stylesheet" type="text/css">
		<link href="assets/css/brands.css" rel="stylesheet" type="text/css">
		<link href="assets/css/solids.css" rel="stylesheet" type="text/css">


		<link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
		<!--Light box-->
		<link href="assets/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
		<!-- carousel -->
		<!-- PrettyPhoto Popup -->
		<link href="assets/css/prettyPhoto.css" rel="stylesheet" />
		<link href="assets/css/plugin/owl.carousel.css" rel="stylesheet" type="text/css">
		<!--Main Slider-->
		<link href="assets/css/settings.css" type="text/css" rel="stylesheet" media="screen">
		<link href="assets/css/layers.css" type="text/css" rel="stylesheet" media="screen">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/bootsnav2.css" rel="stylesheet">
		<link href="assets/css/index.css" rel="stylesheet">
		<link href="assets/css/font/flaticon.css" rel="stylesheet">
		<link href="assets/css/index4.css" rel="stylesheet">
	<!-- Global site tag (gtag.js) - Google Analytics -->
  <script defer src="assets/js/all.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119595512-1');
</script>

	</head>

	<body>
		<!--loader-->
		<div id="preloader">
			<div class="sk-circle">
				<div class="sk-circle1 sk-child"></div>
				<div class="sk-circle2 sk-child"></div>
				<div class="sk-circle3 sk-child"></div>
				<div class="sk-circle4 sk-child"></div>
				<div class="sk-circle5 sk-child"></div>
				<div class="sk-circle6 sk-child"></div>
				<div class="sk-circle7 sk-child"></div>
				<div class="sk-circle8 sk-child"></div>
				<div class="sk-circle9 sk-child"></div>
				<div class="sk-circle10 sk-child"></div>
				<div class="sk-circle11 sk-child"></div>
				<div class="sk-circle12 sk-child"></div>
			</div>
		</div>
		<!--loader-->
		<!--Header Section Start Here
		==================================-->
		<header>
			<div class="middel-part__block" style="background:#00305b">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-lg-4 bg_nav" style="color:#0c1f38">
							<div class="logo">
								<a href="./"> <img src="assets/images/logo.png" alt="Logo"> </a>
							</div>
						</div>
						<div class="col-md-9 col-lg-8" style="background:#12253f">
							<!-- <div class="top-info__block text-right">
                <a class="btn-text"  href="./login">Login</a>
                <a class="btn-text" href="#">Register</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</header>
		<!--Section End Here-->

		<!--  Main Banner Start Here-->
		<div class="main-banner">
			<div id="rev_slider_34_1_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34">
				<!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
				<div id="rev_slider_34_1" class="rev_slider" data-version="5.0.7">
					<ul>
						<!-- SLIDE  -->
						<li data-index="rs-129"  >
							<!-- MAIN IMAGE -->
							<img src="assets/images/banner/slider2.jpg"  alt=""  class="rev-slidebg" >
							<!-- LAYERS -->
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Newspaper-Title tp-resizeme "
							id="slide-129-layer-1"
							data-x="['left','left','left','left']" data-hoffset="['100','50','50','30']"
							data-y="['top','top','top','center']" data-voffset="['165','135','105','0']"
							data-fontsize="['50','50','50','30']"
							data-lineheight="['55','55','55','35']"
							data-width="['600','600','600','420']"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
							data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
							data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
							data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
							data-mask_out="x:0;y:0;s:inherit;e:inherit;"
							data-start="1000"
							data-splitin="none"
							data-splitout="none"
							data-responsive_offset="on" >
								<div class="banner-text">
									<span class="sub-text">Vetogra</span>
									<h2>Join Today For<span> FREE</span></h2>
                  <span style="font-size:28px">Telegram Channel <i class="fab fa-telegram" style="cursor: pointer;" onclick="window.open('https://t.me/vetogra')"></i>
                    <!-- <p style="font-size:20px">
                      Vetogra is a self controlled system, that enables the generation of ETH VETO GAS, with an additional
                      function of ETH VETO TASK.<br>
                      ETH VETO TASK initates the generation process of ETH VETO GASES and converts them to withdrawable ETHEREUM.<br>
                    </p> -->
									<h2 style="font-size:18px; font-style:italic">
									<span>	Vetogra the veto power of Cryptocurrency.<br>
                     Generate and Convert ETH VETO GASES
                   </span>
									</h2>
									<!-- <a class="btn-text" href="about_us.html"> read more</a> -->
									<?php if(isset($_SESSION['@snake_id'])){ ?>
				          <center>
				            <a class="btn-text"  href="./dashboard" style="background:#0c192a">DASHBOARD</a>
				            <a class="btn-text" href="./logout" style="background:#0c192a">LOGOUT</a>
				          </center>
				        <?php }else{ ?>
				          <center>
				            <a class="btn-text"  href="./login" style="background:#0c192a">Login</a>
				              <!-- <h2><span> ETHEREUM </span></h2> -->
				            <a class="btn-text" href="./register" style="background:#0c192a">Register</a>
				          </center>
				        <?php } ?>
								</div>
							</div>
						</li>
					</ul>
					<div class="tp-bannertimer tp-bottom"></div>
				</div>
			</div>
			<!--top Section start Here-->
		<section class="top_section__block" style="background:#12253f">
			<div class="container" style="background:#12253f">
				<div class="row" style="background:#12253f" >
					<div class="col-md-4 col-sm-12">
						<div class="single_top__block text-center" style="background:#0c192a">
							<div class="icon-box__block" style="background:#0c192a">
								<i class="flaticon-rich color"></i>
							</div>
							<div class="single_text__block">

								<h2><a href="#">Ethereum Transaction</a></h2>
								<p>
									Deopsite and withdraw ETH with any wallet of your choice.
									Verified deposite and withdrawal
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="single_top__block text-center" style="background:#0c192a">
							<div class="icon-box__block" style="background:#0c192a">
								<i class="flaticon-rich color"></i>
							</div>
							<div class="single_text__block">

								<h2><a href="#"></a>ETHEREUM GENERATION</h2>
								<p>
									Vetogra is not an ETH minning platform. On vetogra with an active ETH VETOTASK, you can generate and convert ETH VetoGases to ETH
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="single_top__block text-center" style="background:#0c192a">
							<div class="icon-box__block" style="background:#0c192a">
								<i class="flaticon-notes color"></i>
							</div>
							<div class="single_text__block">

								<h2><a href="#">Veto Power</a></h2>
								<p>
									On vetogra everyone have equal power and chances. Accumulation and convertion of ETH VetoGases depends on how you utilise your ETH VetoTASK
								</p>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--top Section End Here-->


		</div>
		<!--  Main Banner End Here-->



    <!-- Story Section -->
  <div id="story-section" class="ptb ptb-xs-60 gray-bg" style="background:#12253f">
    <div class="container">
      <div class="row ">
        <div class="col-sm-12">
          <div class="block-title v-line mb-35">
            <h2><span> Vetogra</span></h2>
            <p class="italic"> The veto power of Cryptocurrency </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="ui-timline-container">
            <div class="ui-timeline">
              <div class="tl-item">
                <div class="tl-body">
                  <div class="tl-entry">
                    <div class="tl-caption">
											<a href="javascript:;" class="btn btn-primary btn-block" style="background:#0c192a">
												<span style="color:#daa106" >VETOGRA</span>
											</a>
										</div>
                  </div>
                </div>
              </div>
              <div class="tl-item">
                <div class="tl-body" >
                  <div class="tl-entry" >
                    <!-- <div class="tl-time"> 2013 </div> -->
                    <!-- <div class="tl-icon btn-icon-round btn-icon btn-icon-thin btn-info" style="background:#12253f" > <i class="fa fa-circle"></i> </div> -->
                    <div class="tl-content" style="background:#0c192a">
                      <h4 class="tl-tile text-primary" style="color:#daa106">Generalized System</h4>
                      <!-- <p style="color:#ffffff"> Vetogra is developed to satisfy absolutely everyone within the system. It is embedded with functioning solution for Affiliate and Non-Affiliate users.</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="tl-item alt">
                <div class="tl-body">
                  <div class="tl-entry">
                    <!-- <div class="tl-time"> 2014 </div> -->
                    <!-- <div class="tl-icon btn-icon-round btn-icon btn-icon-thin btn-warning"> <i class="fa fa-circle"></i> </div> -->
                    <div class="tl-content" style="background:#0c192a">
                      <h4 class="tl-tile text-danger" style="color:#daa106">Equality</h4>
                      <!-- <p style="color:#ffffff">  On vetogra every user is equal and have equal chances of acquiring eth veto gases depending on how you utilize your ETH veto task. Every user is at the apex. </p> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="tl-item">
                <div class="tl-body">
                  <div class="tl-entry">
                    <!-- <div class="tl-time"> 2015 </div> -->
                    <!-- <div class="tl-icon btn-icon-round btn-icon btn-icon-thin btn-success"> <i class="fa fa-circle"></i> </div> -->
                    <div class="tl-content" style="background:#0c192a">
                      <h4 class="tl-tile text-warning" style="color:#daa106">Secured Withdrawal</h4>
                      <p style="color:#ffffff"></p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="tl-item alt">
                <div class="tl-body">
                  <div class="tl-entry">
                    <div class="tl-icon btn-icon-round btn-icon btn-icon-thin btn-danger"> <i class="fa fa-circle"></i> </div>
                    <div class="tl-content">
                      <h4 class="tl-tile text-success">Circular and Sustainable system</h4>
                      <p> Ullam, commodi, modi, impedit nostrum odio sit odit necessitatibus accusantium enim voluptates culpa cupiditate cum pariatur a recusandae tenetur aspernatur at beatae. </p>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

		<!--Counter UP Section Start-->
		<section class="counterUp_wrapper__block padding">
			<div class="container">
				<div class="row">
					<div class="col-md-6 mb-sm-30 mb-xs-30">
						<p style="font-style:italic; font-size:22px"><strong>Vetogra</strong>
              is a self controlled system, that enables the generation of Eth Veto Gases with an additional
              function of Eth Veto Task.<br>
              Eth Veto Task initates the generation process of Eth Veto Gases and converts them to withdrawable ETHEREUM.<br>
            </p>
            <?php if(isset($_SESSION['@snake_id'])){ ?>
              <a class="btn-text mt-15"  href="./dashboard">DASHBOARD</a>
          <?php }else{ ?>
                <a href="./register" class="btn-text mt-15">Be a part of us</a>
          <?php } ?>

					</div>
					<div class="col-md-6">
						<div class="counter_wrap__block text-center">
							<div class="row">
								<div class="col-sm-4 mb-xs-30">
									<div class="single-counterup">
										<!-- <i class="fa fa-trophy"></i> -->
										<?php
										  //  $qry = $snake_dbh->prepare("SELECT id FROM veto_tasks WHERE task_payment_status=1");
										    $qry = $snake_dbh->prepare('SELECT COUNT(*) AS task_num FROM veto_tasks WHERE task_payment_status=1');
										    $qry->execute();
										    $row = $qry->fetchAll(PDO::FETCH_ASSOC)[0];
										    $task_num = ($row['task_num'] + 24)*100;

										    $qryy = $snake_dbh->prepare('SELECT COUNT(*) AS c_task_num FROM veto_tasks WHERE task_payment_status=1 && task_ended=1');
										    $qryy->execute();
										    $roww = $qryy->fetchAll(PDO::FETCH_ASSOC)[0];
										    $c_task_num = ($roww['c_task_num'] + 19)*100;

										    $qr = $snake_dbh->prepare("SELECT COUNT(*) AS user_num FROM users");
										    $qr->execute();
										    $rw = $qr->fetchAll(PDO::FETCH_ASSOC)[0];
										    $user_num = ($rw['user_num'] + 30)*100;
										?>
										<p class="counterup">
											<span class="counter" data-count="<?php echo $task_num ?>">0</span>
										</p>
										<p>
											veto task
										</p>
									</div>
								</div>
								<div class="col-sm-4 mb-xs-30">
									<div class="single-counterup">
										<!-- <i class="fa fa-users"></i> -->
										<p class="counterup">
											<span class="counter" data-count="<?php echo $c_task_num ?>">0</span>
										</p>
										<p>
											Completed VetoTASK
										</p>
									</div>
								</div>
								<div class="col-sm-4 ">
									<div class="single-counterup">
										<!-- <i class="fa fa-user"></i> -->
										<p class="counterup">
											<span class="counter" data-count="<?php echo $user_num ?>">0</span>
										</p>
										<p>
											Users
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Counter UP Section End-->

    <!-- About Section -->
    <section class="services-section__block pt-90 pb-80 ptb-xs-60" style="background:#12253f">
			<div class="container">
        <center><h2><span> FAQ</span></h2></center>

			<div class="pt-60 pt-xs-60">
				<div class="accordion-box accordion-box-1 accordion-box-2 light-color" data-accordion-group>
          <!-- <i class="fa fa-circle"></i> -->
          <div class="accordion" data-accordion>
              <div class="accordion-title" data-control>
                  <p><i class="fas fa-plus"></i>  WHAT IS VETOGRA</p>
              </div>
              <div class="accordion-content animated" data-content>
                 <div class="content-inner">
                      <!-- <strong>Job Description:</strong> -->
                    <ul>
                      <li>
                          Vetogra is a self controlled system, that enables the generation of ETH VETO GAS, with an additional
                          function of ETH VETO TASK.<br>
                          ETH VETO TASK initates the generation process of ETH VETO GASES and converts them to withdrawable ETHEREUM.<br>

                      </li>
                      <li>
                        On vetogra, there is no limit to the amount of ETHEREUM you can accumulate.
                      </li>
                    </ul>
                  </div>
              </div>
          </div>

          <div class="accordion" data-accordion>
              <div class="accordion-title" data-control>
                  <p><i class="fas fa-plus"></i>  WHAT IS ETHEREUM</p>
              </div>
              <div class="accordion-content animated" data-content>
                 <div class="content-inner">
                      <!-- <strong>Job Description:</strong> -->
                    <ul>
                      <li>
                        Ethereum is an open-source, blockchain-based, decentralized software platform used for its own cryptocurrency, ether. It enables SmartContracts and Distributed Applications (ĐApps) to be built and run without any downtime, fraud, control, or interference from a third party
                      </li>
                    </ul>
                  </div>
              </div>
          </div>
                    <div class="accordion" data-accordion>
                        <div class="accordion-title" data-control>
                            <p><i class="fas fa-plus"></i>  WHAT IS VETO TASK</p>
                        </div>
                        <div class="accordion-content animated" data-content>
                            <div class="content-inner">
                                <!-- <strong>Job Description:</strong> -->
                  								<ul>
																	<li>ETH VETO TASK is a self destructable contract used to convert ETH VETO GASES generated
																		 from a user downline or Veto Environment, to reach a certain amount
																		of ETHEREUM(Amount being set by a user while starting a VetoTASK)
																		 &nbsp;
																	 </li><br>
                  								<li>While starting a veto task it is beign set to generate a certain amount of ETHEREUM within the range of (0.2ETH - 10ETH).</li>
																	<br>
																	<li>When an ETH VETO TASK reaches the amount of ETH set for it to generate, it completes it's task to become
																		and Achived ETH VETO TASK ready for withdrawal.<br> Its advisable to start another ETH VETO TASK, so as for you not to loose ETH VETO GASES coming from your downline .</li>
																		<br>
																	<li>If an ETH VETO TASK accumulates and generates a certain amount of ETHEREUM grater than the amount set,
																	the remains becomes a SpillOver VetoGas </li>
																	<li>To initialize an ETH VETO TASK, ETH VETO GAS (20% ) is to be sent to the ETH VETO TASK deposite address</li>
                  								</ul>
																	<strong>Series ETH VETO TASK </strong>
																	<ul>
																		<li>
																			Paralle ETH VETO TASK generates ETH VETO GASES from your downlines.
																		</li>
																		<li>
																			To start a Series ETH VETO TASK, ETH VETO GAS(20% of the ETH VETO TASK) is to be sent to the ETH VETO TASK deposite address.
																		</li>
																	</ul>
																	<strong>Parallel ETH VETO TASK </strong>
																	<ul>
																		<li>
																			Paralle ETH VETO TASK generates ETH VETO GASES from the Veto Environment
																		</li>
																		<li>
																			To start a parallel EHT VETO TASK, ETH VETO GAS(60% of the ETH VETO TASK) is to be sent to the ETH VETO TASK deposite address.
																		</li>
																	</ul>
                  								<strong>NOTE: TRY TO ALWAYS HAVE A VETOTASK</strong>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <!-- <i class="fa fa-circle"></i> -->
                    <div class="accordion" data-accordion>
                        <div class="accordion-title" data-control>
                            <p><i class="fas fa-plus"></i>  WHAT IS VETO GAS</p>
                        </div>
                        <div class="accordion-content animated" data-content>
                            <div class="content-inner">
                                <!-- <strong>Job Description:</strong> -->
              								<ul>
															<li>
																ETH VETO GAS is a certain percentage of a ETH VETO TASK amount, used to execute the generation and conversion of ETH VETO GASES.
																It is begin paid into a ETH VETO TASK address, to initialize the
																Veto Task.&nbsp;
															</li>
              								<!-- <li>Reporting Structure-Will be reporting to Senior VP.</li> -->
              								</ul>
              								<strong>To Start A Series ETH VETO TASK</strong>
              								<ul><li>ETH VETO GAS= 20% of ETH VETO TASK </li>

              								</ul>
															<strong>To Start A Parallel Veto Task</strong>
              								<ul><li>ETH VETO GAS = 60% of ETH Veto Task </li>
															</ul>
															<strong>80% of the ETH VETO GAS adds up to your upline ETH VETO GASES</strong>
															<!-- <a href="#" class="abt-box__content-link"> Find Advisor <i class="fa fa-chevron-circle-right abt-box__content-link-arrow" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <!-- <i class="fa fa-circle"></i> -->
                    <div class="accordion" data-accordion>
                        <div class="accordion-title" data-control>
                            <p><i class="fas fa-plus"></i>  WHAT IS RUNNING ETH VETOTASK</p>
                        </div>
                        <div class="accordion-content animated" data-content>
                           <div class="content-inner">
                                <!-- <strong>Job Description:</strong> -->
              								<ul>
																<li>
																	Running ETH VETO TASK is a Task that have been successfully started and is at the process of acculating and converting ETH VETO GASES</li>
              								</ul>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <!-- <i class="fa fa-circle"></i> -->
                    <div class="accordion" data-accordion>
                        <div class="accordion-title" data-control>
                            <p><i class="fas fa-plus"></i>  WHAT IS ARCHIVED ETH VETO TASK</p>
                        </div>
                        <div class="accordion-content animated" data-content>
                            <div class="content-inner">
                                <!-- <strong>Job Description:</strong> -->
              								<ul>
																<li>
																	Archived ETH VETO TASK is a ETH VETO TASK that have been completed i.e a ETH VETO TASK that have accumulated
																	and converted ETH VETO GASES to reach a certain amount of ETH VETO TASK set ready for withdrawal.
																</li>
															</ul>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <!-- <i class="fa fa-circle"></i> -->
					 				<div class="accordion" data-accordion>
                        <div class="accordion-title" data-control>
                            <p><i class="fas fa-plus"></i>  INVALID VETO TASK</p>
                        </div>
                        <div class="accordion-content animated" data-content>
                            <div class="content-inner">
                                <!-- <strong>Job Description:</strong> -->
															<ul>
																<li>
																	When you pay a lesser amount of ETH VETO GAS FEE while starting an
																	ETH VETO TASK it renders the ETH VETO TASK invalid and can cause you to loose
																	your SpillOver Gases.
																</li>
																<li>
																	But incases of overpayment, the remains of the ETH VETO GAS becomes a spill over ETH VETO GAS.
																</li>
															</ul>
                            </div>
                        </div>
                    </div>

										<div class="accordion" data-accordion>
	                        <div class="accordion-title" data-control>
	                            <p><i class="fas fa-plus"></i>  SPILLOVER ETH VETO GAS</p>
	                        </div>
	                        <div class="accordion-content animated" data-content>
	                            <div class="content-inner">
	                                <strong>You can only have a spillover ETH VETO GAS in any of this two ways:</strong>
																<ul>
																	<!-- <li>
																		Over-Payment of ETH VETO GAS FEE
																	</li> -->
																	<li>
																		When an ETH VETO TASK generates a certain amount of ETH grater than the ETH amount set.
																	</li>
																</ul>
																<strong>Spillover ETH VETO GASES addes up to the next ETH VETO TASK beign started.</stong>
																Amount of veto gases loosed due to In-Active ETH Veto Task.
	                            </div>
	                        </div>
	                    </div>
											<div class="accordion" data-accordion>
		                        <div class="accordion-title" data-control>
		                            <p><i class="fas fa-plus"></i>  ETH VETO BIN</p>
		                        </div>
		                        <div class="accordion-content animated" data-content>
		                            <div class="content-inner">
		                                <strong>Amount of VETO GAESE loosed due to In-Active ETH VETO TASK.</strong>
		                            </div>
		                        </div>
		                    </div>

												<div class="accordion" data-accordion>
			                        <div class="accordion-title" data-control>
			                            <p><i class="fas fa-plus"></i>  ETH VETO ENVIRONMENT</p>
			                        </div>
			                        <div class="accordion-content animated" data-content>
																<div class="content-inner">
																	<ul>
																	<li>
																		ETH VETO GASES lost due to inactive VETO TASK moves into ETH VETO ENVIRONMENT
																	</li>
																	<li>
																		ETHEREUM in the VETO ENVIRONMENT is begin generated and converted by users with active VETO TASK
																	</li>
																</ul>
																</div>
			                        </div>
			                    </div>

                </div>

			</div>
    </div>
  </section>
			<!-- About Section End-->
		<!-- Section box -->
		<section class="padding ptb-xs-60 gray-bg process_section" style="background:#12253f">
			<div class="container" style="background:#12253f">

				<div class="row">
					<div class="col-lg-3 col-sm-6 disp_table text-center mb-sm-30 mb-xs-30">
            <img src="assets/images/series.jpg" style="width:300px"/>
					</div>

					<div class="col-lg-3 col-sm-6 disp_table text-center mb-sm-30 mb-xs-30">
						<img src="assets/images/series1.jpg" style="width:300px"/>
					</div>

					<div class="col-lg-3 col-sm-6 disp_table text-center mb-xs-30">
						<img src="assets/images/parallel.jpg" style="width:300px"/>
					</div>

					<div class="col-lg-3 col-sm-6 disp_table text-center mb-xs-30">
						<img src="assets/images/parallel1.jpg" style="width:300px"/>
					</div>

				</div>

			</div>
		</section>
		<!-- Section box End-->





		<!--form Section-->
		<!-- <section class="ptb-40 bottom-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-12 mb-sm-30 mb-xs-30">
						<div class="contact_block-text">
							<strong>Do you have any questions?</strong>
							<p>
								feel free to contact us!
							</p>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<form>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-field">
										<input class="input-sm form-full" id="name" type="text" name="form-name" placeholder="Your Name">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-field">
										<input class="input-sm form-full" id="email" type="text" name="form-email" placeholder="Email">
									</div>
								</div>
								<div class="col-sm-8">
									<div class="form-field">
										<textarea class="form-full" id="message" rows="7" name="form-message" placeholder="Your Message"></textarea>
									</div>
								</div>
								<div class="col-sm-4 mt-xs-15">
									<button class="btn-text" type="button" id="submit" name="button">
										Submit
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section> -->
		<!--form Section End-->
		<!--Footer Section Start-->
		<footer>

			<div class="main_footer__block pb-0 pt-60">
				<div class="container">
					<div class="copyriight_block ptb-20 mt-20">
						<div class="row">
							<div class="col-sm-6">
								<a href="#" class="footer__block-logo"><img src="assets/images/footer-logo.png" alt=""></a>
							</div>
							<div class="col-sm-6 text-right">
								<p>
									All Rights Reserved
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</footer>
		<!--Footer Section End-->
		<!-- Site Wraper End -->
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>
		<!-- Easing Effect Js -->
		<script src="assets/js/plugin/jquery.easing.js" type="text/javascript"></script>
		<!-- bootstrap Js -->
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- fancybox Js -->
		<script src="assets/js/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
		<script src="assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
		<!-- carousel Js -->
		<script src="assets/js/plugin/owl.carousel.js" type="text/javascript"></script>
		<!-- imagesloaded Js -->
		<script src="assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
		<!-- masonry,isotope Effect Js -->
		<script src="assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
		<script src="assets/js/isotope.pkgd.min.js" type="text/javascript"></script>
		<script src="assets/js/masonry.pkgd.min.js" type="text/javascript"></script>
		<script src="assets/js/jquery.appear.js" type="text/javascript"></script>
		<!-- Height Js -->
		<script src="assets/js/jquery.matchHeight-min.js" type="text/javascript"></script>
		<!-- parallax Js -->
		<script src="assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>

		<!-- revolution Js -->
		<script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="assets/extensions/revolution.extension.slideanims.min.js"></script>
		<script type="text/javascript" src="assets/extensions/revolution.extension.layeranimation.min.js"></script>
		<script type="text/javascript" src="assets/extensions/revolution.extension.navigation.min.js"></script>
		<script type="text/javascript" src="assets/extensions/revolution.extension.parallax.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.revolution.js"></script>
    <!-- accordion Js -->
 <script src="assets/js/jquery.accordion.js" type="text/javascript"></script>
		<!-- custom Js -->
		<script src="assets/js/custom.js" type="text/javascript"></script>

	</body>

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:20:43 GMT -->
</html>
