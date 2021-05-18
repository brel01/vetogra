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
    <div class="middel-part__block" style="background:#00305b">
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
                <strong>Error</strong> <span id="reg_error_txt"></span>
              </div>
            </div>

            <div class="card bg-white">
              <div class="card-content">
                <section class="logo text-center">
                  <h2>Register</h2>
                </section>
                <form class="form-horizontal ng-pristine ng-valid">
                  <fieldset>
                    <div class="form-group">
                      <!-- <label>REFERRER <small>optional</small> </label> -->
                      <label style="margin-bottom:0px"><span style="margin-bottom: 18, color: #999; font-size: 14px; font-weight: normal; position: absolute; pointer-events: none; left: 0; top: 10px;">REFERRER <small>optional</small></span>

                      </label>
                      <div class="ui-input-group">
                        <input type="text" required class="form-control" id="referrer"
                        <?php
                        if(isset($_GET)){
                          if(isset($_GET['ref'])){
                            if(strlen($_GET['ref']) > 0){
                              $ref = $_GET["ref"];
                              ?>
                              value="<?php echo $ref ?>" readonly
                              <?php

                            }
                          }
                        }
                        ?>
                        >
                        <span class="input-bar" placeholder="The username of the person that referred you"></span>

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="ui-input-group">
                        <input type="text" id="uname" required  class="form-control">
                        <span class="input-bar"></span>
                        <label>USERNAME <span id="uname_error"><small style="color:red"><i class="fa fa-close"></i> empty</small></span></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="ui-input-group">
                        <input type="text" id="fname" required  class="form-control">
                        <span class="input-bar"></span>
                        <label>FULLNAME
                          <span id="fname_error">
                            <small style="color:red"><i class="fa fa-close"></i> empty</small>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="ui-input-group">
                        <input type="email" id="uemail" required  class="form-control">
                        <span class="input-bar"></span>
                        <label>EMAIL
                          <span id="uemail_error">
                            <small style="color:red"><i class="fa fa-close"></i> </small><small style="color:red" id="uemail_error_txt">empty</small>
                          </span>
                        </label>
                      </div>
                    </div>


                    <div class="form-group">
                        <label style="margin-bottom:20px"><span style="margin-bottom: 18, color: #999; font-size: 14px; font-weight: normal; position: absolute; pointer-events: none; left: 0; top: 10px;">Country</span>
                          <div id="country_error">
                            <small style="color:red"><i class="fa fa-close"></i> </small><small style="color:red" id="country_error_txt">select country</small>
                          </div>
                        </label>

                    <div>
                      <select value="FRA"
                              data-role="country-selector"
                              data-show-flag="true"
                              >
                      </select>

                    </div>
                    </div>

                    <div class="form-group">
                      <div class="ui-input-group">
                        <input type="password" id="pwd"  required class="form-control">
                        <span class="input-bar"></span>
                        <label>PASSWORD
                          <span id="pwd_error">
                            <small style="color:red"><i class="fa fa-close"></i> </small><small style="color:red" id="pwd_error_txt">empty</small>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="spacer"></div>
                    <div class="form-group checkbox-field">
                      <span id="check_error">
                        <small style="color:red"><i class="fa fa-close"></i> </small><small style="color:red" id="check_error_txt">To register you have to agree to our terms and condition</small>
                      </span><br>
                      <label for="check_box" class="text-small">
                        <input type="hidden" name="user_check" id="user_check" value="no">
                        <span>
                        <input type="checkbox" id="check_box">
                        <span class="ion-ios-checkmark-empty22 custom-check"></span> By clicking on sign up, you agree to <a href="javascript:;"><i>terms</i></a> and <a href="javascript:;"><i>privacy policy</i></a></label>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="card-action no-border text-right"> <a href="../login"> Login</a><a  onClick="user_register()" class="btn color-primary">Sign Up</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Login Section -->

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
  <div class="verify" id="verify">
    <div class="body-inner">
      <!-- error -->
      <div id="reg_error" class="appointment_succses">
        <div role="alert" class="alert alert-success">
          <strong>Registraton Succesfull</strong> Welcome to the veto community <span id="reg_error_txt"></span>
        </div>
      </div>
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
<script src="./js/jquery.countrySelector.js" type="text/javascript"></script>
<script>
$("#reg_error").hide();
$("#uname_error").hide();
$("#fname_error").hide();
$("#uemail_error").hide();
$("#pwd_error").hide();
$("#country_error").hide();
$("#check_error").hide();
$("#roller").hide();
$("#verify").hide();

function hide_all_error(){
  $("#reg_error").hide();
  $("#uname_error").hide();
  $("#fname_error").hide();
  $("#uemail_error").hide();
  $("#pwd_error").hide();
  $("#country_error").hide();
  $("#check_error").hide();
}

function user_check(){
  var check = $("#user_check").val() ;
  if(check == "no"){
    $('input[name=user_check]').val('yes');
  }else if(check == "yes"){
    $('input[name=user_check]').val('no');
  }
}


document.getElementById("check_box").addEventListener("click", user_check);

function user_register(){
  var referrer = $("#referrer").val();
  var uname = $("#uname").val();
  if(uname.length > 0){
    $("#uname_error").hide();
    var fname = $("#fname").val();
    if(fname.length > 0){
      $("#fname_error").hide();
      var uemail = $("#uemail").val();
      if(uemail.length > 0){
        $("#uemail_error").hide();
        if(uemail.search("@") > -1){
          $("#uemail_error").hide();
          if(uemail.search(/\./) > -1){
            $("#uemail_error").hide();
            var country = window.country;
            if(country !== undefined){
              $("#country_error").hide();
              var pwd = $("#pwd").val();
              if(pwd.length > 0){
                $("#pwd_error").hide();
                if(pwd.length > 7){
                  $("#pwd_error").hide();
                  var check_box = $("#user_check").val();
                  if(check_box == "yes"){
                    $("#check_error").hide();
                    $("#login").hide();
                    $("#roller").show();
                    hide_all_error();
                    $.ajax({
                      type: 'POST',
                      url: '../register_handler.php',
                      data: {fname:fname, uname:uname, uemail:uemail, country:country, pwd:pwd, referrer:referrer},
                      dataType: 'json',
                      success: function(response){
                        if(response == "success"){
                          window.location.replace("../verify");
                        }else{
                          $("#roller").hide();
                          $("#login").show();
                          document.getElementById("reg_error_txt").innerHTML = response;
                          $("#reg_error").show();
                        }
                      }
                    })
                  }else{
                    $("#check_error").show();
                  }
                }else{
                  document.getElementById('pwd_error_txt').innerHTML = "Your password needs to be at least 8 characters long";
                  $("#pwd_error").show();
                }
              }else{
                document.getElementById('pwd_error_txt').innerHTML = "Empty";
                $("#pwd_error").show();
              }
            }else{
              document.getElementById('country_error_txt').innerHTML = "select country";
              $("#country_error").show();
            }
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
    }else{
      $("#fname_error").show();
    }
  }else{
    $("#uname_error").show();
  }
}

</script>
</body>

<!-- Mirrored from theembazaar.com/demo/appsitebox/bitcrypto/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 14:25:30 GMT -->
</html>
