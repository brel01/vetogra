<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:30 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Vetogra</title>
	   <!-- Favicone Icon -->
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.png">
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
  <!-- Login Section -->
  <div id="login" class="ptb ptb-xs-60 page-signin">
    <div class="container">
      <div class="row">
        <div class="main-body">
          <div class="body-inner">
            <!-- error -->
            <div id="reg_error" class="appointment_succses">
              <div role="alert" class="alert alert-danger">
                <strong>Error</strong> <span id="error_txt"></span>
              </div>
            </div>

            <div class="card bg-white">
              <div class="card-content">
                <section class="logo text-center">
                  <h2>Forgot Password</h2>
                </section>
                <form class="form-horizontal ng-pristine ng-valid">
                  <fieldset>
                    <div class="form-group">
                      <div class="ui-input-group">
                        <input type="email" id="uemail" required  class="form-control">
                        <span class="input-bar"></span>
                        <label>ENTER EMAIL<span id="uemail_error"><small style="color:red"><i class="fa fa-close"></i> empty</small></span></label>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="card-action no-border text-right"> <a href="../login"> Login</a><a  onClick="submit_email()" class="color-primary">SUBMIT</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Login Section -->

  <!-- roller -->
  <div id="roller" style="margin-top:350px">
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
  <div id="verify" class="ptb ptb-xs-60 page-signin verify">
    <div class="container">
      <div class="row">
        <div class="main-body">
          <div class="" id="">
            <div class="body-inner">
              <!-- error -->
              <div id="reg_error" class="appointment_succses">
                <div role="alert" class="alert alert-success">
                  <strong>Password Recovery message sent</strong><span id="reg_error_txt"></span>
                </div>
              </div>
              <div class="card bg-white">
                <div class="card-content">
                  <section class="logo text-center">
                    <h2>Forgot Password</h2>

                  </section>
                  <center><p style="color:#0c1f38"><b>Click on the link attached to the email sent to you</b></p></center>
                    <!-- <center><a class="btn-text" href="#">Re-Send Email</a></center> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
<script>
$("#reg_error").hide();
$("#uemail_error").hide();
$("#roller").hide();
$("#verify").hide();

function hide_all_error(){
  $("#reg_error").hide();
  $("#uemail_error").hide();
}




function submit_email(){
      var uemail = $("#uemail").val();
      if(uemail.length > 0){
        $("#uemail_error").hide();
        if(uemail.search("@") > -1){
          $("#uemail_error").hide();
          if(uemail.search(/\./) > -1){
            $("#uemail_error").hide();
            $("#login").hide();
            $("#roller").show();
            $.ajax({
              type: 'POST',
              url: '../forgot_password.php',
              data: {uemail:uemail},
              dataType: 'json',
              success: function(response){
                if(response == "success"){
                  $("#roller").hide();
                  $("#verify").show();
                }else{
                  $("#roller").hide();
                  $("#reg_error").show();
                  document.getElementById("error_txt").innerHTML = response;
                  $("#login").show();
                }
              }
            })
          }else{
            document.getElementById('uemail_error_txt').innerHTML = "Invalid";
            $("#uemail_error").show();
          }
        }else{
          document.getElementById('uemail_error_txt').innerHTML = "Invalid";
          $("#uemail_error").show();
        }
      }else{
        document.getElementById('uemail_error_txt').innerHTML = "empty";
        $("#uemail_error").show();
      }
}

</script>
</body>

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:30 GMT -->
</html>
