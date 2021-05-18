// $(document).on('ready',function() {
$('#login_error').hide();
// }


function submit_details(){
  var uemail = $("#uemail").val();
  var password = $("#pwd").val();
  if(uemail.length > 0){
    if(password.length > 0){
      if(password.length > 7){
        if(uemail.search("@") == -1 ){
          if(uemail.search(".") == -1 ){
            $.ajax({
              type: 'POST',
              url: 'login_handler.php',
              dataType: 'json',
              success: function(response){
              }
            })
          }else{
            var error = "Invaild email";
          }
        }else{
          var error = "Invalid email";
        }
      }else{
        var error = "Incorrect passwod";
      }
    }
  }
}
