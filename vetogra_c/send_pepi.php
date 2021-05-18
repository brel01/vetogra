<?php
// $message = "
//                       <center><img src='https://www.metricplux.com/assets/images/email_logo.jpg' style='height:50%; width:50%' /></center>
//                       <center><h2>VETOGRA</h2>
//                       <p>fname</p>
//                       <p>Your Registration Is Successfull</p>
//                       <p>Welcome to the veto community of crypto</p>
//                       <a href='http://www.metricplux.com/verification?v=vcode&u=uname'>Verify</a>
//                       </center>
//                     ";
                    # Consider using the following php curl function.
                    function add_template() {
                      $params = array(
                        'template'    => '<div class="entry"><center><img src="https://www.metricplux.com/assets/images/email_logo.jpg" style="height:50%; width:50%" /></center><center><h2>VETOGRA</h2><h1>{{title}}</h1> <div class="body"> {{body}} </div> </div>',
                        'name'        => 'Test template',
                        'description' => 'sample_template'
                      );

                      $ch = curl_init();

                      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                      curl_setopt($ch, CURLOPT_USERPWD, 'api:1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62');
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                      curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/YOUR_DOMAIN_NAME/templates');
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

                      $result = curl_exec($ch);
                      curl_close($ch);

                      return $result;
                    }
?>
