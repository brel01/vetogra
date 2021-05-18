<?php
session_start();
include("../snake.php");
include("../functions.php");
// $uname = get_uname($_SESSION["_@_uemail"]);
// if(!isset($_SESSION["_@_uemail"])){
//   header('location: ../');
// }
//
// if(isset($_SESSION["_@_uemail"])){
//   $qri = $snake_dbh->prepare("SELECT id FROM users WHERE useremail=?");
//   $qri->execute([$_SESSION["_@_uemail"]]);
//   if($qri->rowCount() != 1){
//     header('location: ../');
//   }else{
//     null;
//   }
// }
?>
<?php
// include("../snake.php");
// if(isset($_GET)){
  $uname = $_GET['u'];
  $v_code = $_GET['v'];

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE username=? && v_code=?");
  $query->execute([$uname, $v_code]);
  if($query->rowCount() > 0){
    $s = "";
    $one = 1;
    $qry = $snake_dbh->prepare("UPDATE users SET verified=?, v_code=? WHERE username=?");
    $qry->execute([$one, $s, $uname]);
    if($qry){
      $qy = $snake_dbh->prepare("SELECT id FROM users WHERE username=? && verified=1 && v_code=? ");
      $qy->execute([$uname, $s]);
      if($qy->rowCount() == 1){
        header("location: ../verify");
      }else{
        header("location: ../");
      }
    }else{
      header("location: ../");
    }
  }else{
    header("location: ../");
  }
// }else{
//   header("location: ../");
// }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:30 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Vetogra</title>
	   <!-- Favicone Icon -->
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,800%7CLato:300,400,700" rel="stylesheet" type="text/css">
        <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/ionicons.css" rel="stylesheet" type="text/css">
        <!--Light box-->
		<link href="../assets/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
        <!-- carousel -->
        <!-- PrettyPhoto Popup -->
		<link href="../assets/css/prettyPhoto.css" rel="stylesheet" />
        <link href="../assets/css/plugin/owl.carousel.css" rel="stylesheet" type="text/css">
		<!--Main Slider-->
		<link href="../assets/css/settings.css" type="text/css" rel="stylesheet" media="screen">
		<link href="../assets/css/layers.css" type="text/css" rel="stylesheet" media="screen">
		<link href="../assets/css/style.css" rel="stylesheet">
		 <link href="../assets/css/bootsnav2.css" rel="stylesheet">
		 <link href="../assets/css/footer.css" rel="stylesheet">
     <link href="./css/jquery-countryselector.min.css" rel="stylesheet">
         <!-- Global site tag (gtag.js) - Google Analytics -->
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
<!-- Site Wraper -->
<div class="wrapper">
  <!-- HEADER -->
  <!--Start header area-->
  <header>
    <div class="middel-part__block">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-lg-4 bg_nav">
            <div class="logo">
              <a href="../"> <img src="../assets/images/logo.png" alt="Logo"> </a>
            </div>
          </div>
          <div class="col-md-9 col-lg-8">
            <!-- <div class="top-info__block text-right">
              <a class="btn-text" href="../login">Login</a>
              <a class="btn-text" href="#">Register</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </header>
  <!--End mainmenu area-->
  <!-- END HEADER -->
  <!-- Intro Section -->
  <!-- <section class="inner-intro bg-img light-color overlay-before parallax-background">
    <div class="container">
      <div class="row title">
        <h1 data-title="register"><span>register</span></h1>
      </div>
    </div>
  </section> -->
  <!-- Intro Section -->

  <!-- roller -->
  <div id="roller" style="margin-top:250px">
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
  <!-- roller -->

  <!--verify-->

  <!-- end verify -->

  <!-- FOOTER -->

<!-- END FOOTER -->
</div>
<!-- Site Wraper End -->
<script src="../assets/js/jquery.min.js" type="text/javascript"></script>
<!-- Easing Effect Js -->
<script src="../assets/js/plugin/jquery.easing.js" type="text/javascript"></script>
<!-- bootstrap Js -->
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- carousel Js -->
<script src="../assets/js/plugin/owl.carousel.js" type="text/javascript"></script>
<!-- imagesloaded Js -->
<script src="../assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<!-- masonry,isotope Effect Js -->
<script src="../assets/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="../assets/js/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery.appear.js" type="text/javascript"></script>
<!-- parallax Js -->
<script src="../assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../../../maps.google.com/maps/api/jse8d0?sensor=false&amp;.js"></script>
<!-- custom Js -->
<script src="../assets/js/custom.js" type="text/javascript"></script>
<script src="./js/jquery.countryselector.js" type="text/javascript"></script>
<script type="text/javascript">
// setInterval(function(){ check() }, 8000);
$("#roller").show();
</script>
</body>

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:30 GMT -->
</html>
