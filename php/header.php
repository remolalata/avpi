<?php
ob_start();
session_start();
include'php/db_connection.php';
date_default_timezone_set('Asia/Manila');

if(!$_SESSION['user_id']){
  header("location: login.php");
}

$the_user = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where user_id=".$_SESSION['user_id']));
if(empty($the_user['image_path']) or $the_user['image_path'] == "image/user_image/"){
  $the_image_path = "image/default_user.png";
}else{
  $the_image_path = $the_user['image_path'];
}

//for testing purposes
// $school_year_start = '17';
$school_year_start = date('y');

$server_name = "/avpi/trunk/";
// $server_name = "/avpsms/";

function website_title($server){
  if($server."index.php" == $_SERVER['PHP_SELF']){
    return "AVPI School Management System";
  }else{
    $string = "AVPI ".ucfirst(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
    return str_replace('-', ' ', str_replace('_', ' ', $string));
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo website_title($server_name); ?></title>
  <link rel="icon" type="image/png" href="image/logo.png">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php if($_SERVER['PHP_SELF'] == $server_name."schedule.php" || $_SERVER['PHP_SELF'] == $server_name."assign_subject.php" || $_SERVER['PHP_SELF'] == $server_name."subjects.php" || $_SERVER['PHP_SELF'] == $server_name."instructor.php"){ ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
  <?php } ?>
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="dist/style.css">

  <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper">

  <header class="main-header">

    <a class="logo">
      <span class="logo-mini">AVPI</b></span>
      <span class="logo-lg"><b>AVPI</b></span>
    </a>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $the_image_path; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucfirst($the_user['first_name'])." ".ucfirst($the_user['last_name']); ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header" style="height: auto">
                <img src="<?php echo $the_image_path; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo ucfirst($the_user['first_name'])." ".ucfirst($the_user['last_name'])." - ".ucfirst($the_user['user_type']); ?>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="php/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">

    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $the_image_path; ?>" class="img-circle" style="width: 45px !important; height: 45px !important">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($the_user['first_name'])." ".ucfirst($the_user['last_name']); ?></p>
          <a><?php echo ucfirst($the_user['user_type']); ?></a>
        </div>
      </div>

      <ul class="sidebar-menu">
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."index.php"){ echo "class='active'"; } ?> >
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."church.php"){ echo "class='active'"; } ?> >
          <a href="church.php">
            <i class="fa fa-home"></i> <span>Church</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."users.php"){ echo "class='active'"; } ?> >
          <a href="users.php">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."instructor.php"){ echo "class='active'"; } ?> >
          <a href="instructor.php">
            <i class="fa fa-user"></i> <span>Instructors</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."course-section.php"){ echo "class='active'"; } ?> >
          <a href="course-section.php">
            <i class="fa fa-file-text-o"></i> <span>Course & Section</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."subjects.php"){ echo "class='active'"; } ?> >
          <a href="subjects.php">
            <i class="fa fa-clipboard"></i> <span>Subjects</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."assign_subject.php"){ echo "class='active'"; } ?> >
          <a href="assign_subject.php">
            <i class="fa fa-user"></i> <span>Assign Subjects</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal" || $the_user['user_type'] == "instructor" || $the_user['user_type'] == "encoder"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."students.php"){ echo "class='active'"; } ?> >
          <a href="students.php">
            <i class="fa fa-child"></i> <span>Students</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."enrollment.php"){ echo "class='active'"; } ?> >
          <a href="enrollment.php">
            <i class="fa fa-briefcase"></i> <span>Enrollment</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin" or $the_user['user_type'] == "encoder" or $the_user['user_type'] == "instructor" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."grade.php"){ echo "class='active'"; } ?> >
          <a href="grade.php">
            <i class="fa fa-edit"></i> <span>Grades</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin"){ ?>
        <!--<li <?php if($_SERVER['PHP_SELF'] == $server_name."schedule.php"){ echo "class='active'"; } ?> >
          <a href="schedule.php">
            <i class="fa fa-calendar"></i> <span>Schedule</span>
          </a>
        </li> -->
        <?php } ?>


        <?php if($the_user['user_type'] == "admin" or $the_user['user_type'] == "printer" || $the_user['user_type'] == "principal"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."print.php"){ echo "class='active'"; } ?> >
          <a href="print.php">
            <i class="fa fa-print"></i> <span>Print</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin"){ ?>
        <li>
          <a href="end_school_year.php">
            <i class="fa fa-gear"></i> <span>End School Year</span>
          </a>
        </li>
        <?php } ?>

        <?php if($the_user['user_type'] == "admin"){ ?>
        <li <?php if($_SERVER['PHP_SELF'] == $server_name."logs.php"){ echo "class='active'"; } ?> >
          <a href="logs.php">
            <i class="fa fa-list"></i> <span>Logs</span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
