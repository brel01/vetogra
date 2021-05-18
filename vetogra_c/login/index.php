<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:31 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Vetogra</title>
	   <!-- Favicone Icon -->
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,800%7CLato:300,400,700" rel="stylesheet" type="text/css">
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
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
		 <link href="assets/css/footer.css" rel="stylesheet">
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
    <div class="middel-part__block" style="background:#00305b">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-lg-4 bg_nav">
            <div class="logo">
              <a href="../"> <img src="assets/images/logo.png" alt="Logo"> </a>
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
        <h1 data-title="login"><span>login</span></h1>
      </div>
    </div>
  </section> -->
  <!-- Intro Section -->
  <!-- Login Section -->
  <div id="login" class="ptb ptb-xs-60 page-signin">
    <div class="container">
      <div class="row">
        <div class="main-body">
          <!-- LOIGN MAIN body -->
          <div class="login_main">
            <div class="body-inner">
              <div id="login_error" class="appointment_succses">
    						<div role="alert" class="alert alert-danger">
    							<strong>Error</strong> <span id="login_error_txt"></span>
    						</div>
    					</div>
              <div class="card bg-white">
                <div class="card-content">
                  <section class="logo text-center">
                    <h2>Login</h2>
                  </section>
                  <form class="form-horizontal ng-pristine ng-valid">
                    <fieldset>
                      <div class="form-group">
                        <div class="ui-input-group">
                          <input type="email" id="uemail" required class="form-control">
                          <span class="input-bar"></span>
                          <label>Email</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="ui-input-group">
                          <input type="password" class="form-control"  id="pwd" >
                          <span class="input-bar"></span>
                          <label>Password</label>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div class="card-action no-border text-right"> <a onclick="submit_details()" class="btn color-primary">Sign in</a> </div>
              </div>
              <div class="additional-info"> <a href="../register" style="color:#0c1f38"><b>Register</b></a><span class="divider-h"></span><a href="../forgot_password" style="color:#0c1f38" ><b>Forgot your password?</b></a> </div>
            </div>
          </div>

          <!-- roller -->
          <div id="roller" style="margin-top:200px">
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

          <!-- NOT VERIFIEd -->
          <div class="not_verified">
            <div class="body-inner">
              <!-- <div id="login_error" class="appointment_succses">
    						<div role="alert" class="alert alert-danger">
    							<strong>Error</strong> <span id="login_error_txt"></span>
    						</div>
    					</div> -->
              <div class="card bg-white">
                <div class="card-content">
                  <section class="logo text-center">
                    <h2>Verify Account</h2>

                  </section>
                  <p style="color:#0c1f38"><b>Click on the link attached to the email sent to you</b></p>
                    <center><a class="btn-text" href="#">Re-Send Email</a></center>
                </div>
              </div>
            </div>
          </div>
          <!-- end verify -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Login Section -->
 <!-- FOOTER -->
			 <!-- <footer>
		    <div class="top_footer_info__block ptb-20">
		        <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="single_info__block">
                                <i class="fa fa-phone"></i>
                                <h4>0(000) 000 000 <span>Monday-Friday, 8am-7pm</span></h4>
                            </div>
                        </div>
                    </div>
		        </div>
            </div>

		</footer> -->
<!-- END FOOTER -->
</div>
<!-- Site Wraper End -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<!-- Easing Effect Js -->
<script src="assets/js/plugin/jquery.easing.js" type="text/javascript"></script>
<!-- bootstrap Js -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- carousel Js -->
<script src="assets/js/plugin/owl.carousel.js" type="text/javascript"></script>
<!-- imagesloaded Js -->
<script src="assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<!-- masonry,isotope Effect Js -->
<script src="assets/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="assets/js/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.appear.js" type="text/javascript"></script>
<!-- parallax Js -->
<script src="assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../../maps.google.com/maps/api/jse8d0?sensor=false&amp;.js"></script>
<!-- revolution Js -->
<script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="assets/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="assets/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="assets/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="assets/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.revolution.js"></script>
<!-- custom Js -->
<script src="assets/js/custom.js" type="text/javascript"></script>

<script type="text/javascript">
// $(document).on('ready',function() {
$('#login_error').hide();
$('.not_verified').hide();
$("#roller").hide();
// }


function submit_details(){
  var uemail = $("#uemail").val();
  var password = $("#pwd").val();
  if(uemail.length > 0){
    if(password.length > 0){
      if(password.length > 7){
        if(uemail.search("@") > -1 ){
          if(uemail.search(/\./) > -1 ){
            $(".login_main").hide()
            $("#login_error").hide()
            $("#roller").show();
            $.ajax({
              type: 'POST',
              url: '../login_handler.php',
              data: {uemail:uemail, pwd:password},
              dataType: 'json',
              success: function(response){
                if(response == "not verified"){
                  document.getElementById('login_error_txt').innerHTML = "";
                  window.location.replace("../verify");
                  // $("#login_error").hide();
                  // $(".login_main").hide();
                  // $(".not_verified").show();
                  // $("#roller").hide();
                }else if(response == "no eth address"){
                  window.location.replace("../dashboard");
                  // $("#roller").hide();
                  // document.getElementById('login_error_txt').innerHTML = "";
                  // $("#login_error").hide();
                }else if(response == "success"){
                  window.location.replace("../dashboard");
                  // $("#roller").hide();
                  // document.getElementById('login_error_txt').innerHTML = "";
                  // $("#login_error").hide();
                }else{
                  $("#roller").hide();
                  var error = response;
                  document.getElementById('login_error_txt').innerHTML = error;
                  $(".login_main").show();
                  $("#login_body").show()
                  $("#login_error").show();

                  setTimeout(function(){
                    $("#login_error").hide();
                  }, 2000);
                }
              }
            })
          }else{
            var error = "Invaild email";
            document.getElementById('login_error_txt').innerHTML = error;
            $("#login_error").show();

            setTimeout(function(){
            $("#login_error").hide();
        }, 2000);
          }
        }else{
          var error = "Invalid email";
          document.getElementById('login_error_txt').innerHTML = error;
          $("#login_error").show();

          setTimeout(function(){
            $("#login_error").hide();
        }, 2000);
        }
      }else{
        var error = "Invalid password";
        document.getElementById('login_error_txt').innerHTML = error;
        $("#login_error").show();

        setTimeout(function(){
            $("#login_error").hide();
        }, 2000);
      }
    }else{
        var error = "Password cannot be empty";
        document.getElementById('login_error_txt').innerHTML = error;
        $("#login_error").show();

        setTimeout(function(){
            $("#login_error").hide();
        }, 2000);
    }
  }
}

</script>
</body>

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:31 GMT -->
</html>
