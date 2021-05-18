<?php
use Mailgun\Mailgun;
require 'mailgun/vendor/autoload.php';
//
// # Instantiate the client.
// $mg = Mailgun::create('1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62', 'https://api.mailgun.net/v3/mg.vetogra.com');
// $domain = "mg.vetogra.com";
// $params = array(
//   'from'    => 'Excited User <support@vetogra.com>',
//   'to'      => 'arowolajutunde@gmail.com',
//   'subject' => 'Hello',
//   'text'    => 'Testing some Mailgun awesomness!'
// );
//
// # Make the call to the client.
// $mg->messages()->send($domain, $params);
// if($mg){
//   echo "success";
// }
//
// ?>
<?php
# Currently, the PHP SDK does not support the Templates endpoint.
// # Consider using the following php curl function.
// <center><img src='https://www.metricplux.com/assets/images/email_logo.jpg' style='height:50%; width:50%'  /></center>
// <center><h2>VETOGRA</h2>
// <p>".$fname."</p>
// <p>Your Registration Is Successfull</p>
// <p>Thank You For Registering With Us</p>
// <a href='https://metricplux.com/verification?v=".$vcode."&u=".$uname."'>Verify</a>
// </center>

// function add_template() {
  $params = array(
    // 'template'    => '<div class="entry"> <h1>{{title}}</h1> <div class="body"> {{body}} </div> </div>',
    'template'    => '<center><img src="https://www.vetogra.com/assets/images/email_logo.jpg" style="height:50%; width:50%"  /></center><h1>Hey {{fname}}</h1><p><strong><h2>Password Recovery</h2></strong></p><h3>Click on the Link below</h3><br><span><p style="font-size:16px">Link: </p><a href="{{link}}" style="font-size:16px">Change Password</a></span>',
    'name'        => 'forgot5',
    'description' => 'forgot_template'
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/mg.vetogra.com/templates');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  $result = curl_exec($ch);
  curl_close($ch);
  echo $result;
// }

?>
<?php
# Include the Autoloader (see "Libraries" for install instructions)
// require 'mailgun/vendor/autoload.php';
// use Mailgun\Mailgun;

$fname = "Arowolaju Tunde";
$uemail = "arowolajutunde@gmail.com";
$uname = "brel01";
$vcode = "jrjgtejgbeutibgebrogbeuorgboue";
$link = "https://vetogra.com/verification?v=".$vcode."&u=".$uname."";
// $button = "<a href='https://vetogra.com/verification?v=".$vcode."&u=".$uname."'>Verify</a>";
# Instantiate the client.
$mgClient = Mailgun::create('1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62', 'https://api.mailgun.net/v3/mg.vetogra.com');
$domain = "mg.vetogra.com";
$params = array(
    'from'                  => 'noreply <noreply@vetogra.com>',
    'to'                    => $uemail,
    'subject'               => 'Forgot Password',
    'template'              => 'forgot5',
    'v:fname'  => $fname,
    'v:link'   => $link
    );

# Make the call to the client.
$result = $mgClient->messages()->send($domain, $params);
var_dump($result);
?>
