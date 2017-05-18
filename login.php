<?php
ob_start();
session_start();
include'php/db_connection.php';
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AVPI System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="image/logo.png">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/bootbox.min.js"></script>

  <style>
  .btn-primary {
    background-color: #df2a2a !important;
    border-color: #c82525 !important;
  }
  .btn-primary:hover {
    background-color: #c82525 !important;
    border-color: #c82525 !important;
  }
  .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover{
    background-color: #c82525 !important;
    border-color: #c82525 !important;
  }
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box" style="margin-top: 2%;">
  <div class="login-logo">
    <img src="image/logo.png" class="img-circle" alt="User Image" style="max-width: 180px">
  </div>
  <div class="login-box-body">
    <p></p>
    <form method="post" id="loginForm" class="validate-form">
      <input type="hidden" name="check" value="check">
      <div class="form-group" id="user_type_error">
        <select name="usertype" class="form-control" required >
          <option value="">User Level</option>
          <option value="admin">Admin</option>
          <option value="instructor">Instructor</option>
          <option value="encoder">Encoder</option>
          <option value="printer">Printer</option>
        </select>
      </div>
      <div class="form-group has-feedback" id="username_error">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" title="required input" required />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" id="password_error">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-toggle="tooltip" data-trigger="manual" data-title="Caps lock is on" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

  </div>
</div>

<?php
  if(isset($_POST['check'])){
    $user_type = $_POST['usertype'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $key_password="password";
    $encrypted_string=openssl_encrypt($password,"AES-128-ECB",$key_password);
    $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$key_password);

    $query = mysqli_query($conn, "select * from users where user_type='$user_type' and username='$username' and password='$encrypted_string'") or die(mysqli_error());
    $count = mysqli_num_rows($query);

    if(empty($count)){
      echo "
        <script>
          bootbox.alert('Invalid Username and Password!');
        </script>
      ";
    }else{
      $row = mysqli_fetch_assoc($query);
      $name = ucfirst($row['first_name'])." ".ucfirst($row['last_name']);
      $user_type = ucfirst($row['user_type']);
      $date = date("M-d-Y");
      $time = date("h:i A");
      $ip_address = $_SERVER['REMOTE_ADDR'];
      $_SESSION['user_id'] = $row['user_id'];
      mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('$name', '$user_type', 'Log In', '$date', '$time', '$ip_address') ") or die(mysqli_error());
      header("location: index.php");
    }

  }
?>

<script src="plugins/webshim/js-webshim/minified/polyfiller.js"></script>
<script>jQuery.webshims.polyfill('forms');</script>
<script>

  $('[type=password]').keypress(function(e) {
    var $password = $(this),
        tooltipVisible = $('.tooltip').is(':visible'),
        s = String.fromCharCode(e.which);
    
    //Check if capslock is on. No easy way to test for this
    //Tests if letter is upper case and the shift key is NOT pressed.
    if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
      if (!tooltipVisible)
        $password.tooltip('show');
    } else {
      if (tooltipVisible)
        $password.tooltip('hide');
    }
    
    //Hide the tooltip when moving away from the password field
    $password.blur(function(e) {
      $password.tooltip('hide');
    });
  });
</script>
</body>
</html>
