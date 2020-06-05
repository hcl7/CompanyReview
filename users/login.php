<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - Login page</title>
<META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
<link rel="icon" href="images/favicon.ico">

<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="theme-color" content="#292929">
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" sizes="196x196" href="#">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="Vlereso">

<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>
<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/social-buttons.css" type="text/css" />
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />

</head>
<body>
<div id="wrapper" class="wrapper">
<!-- start of header -->
<div class="ng-scope" style="background: #292929;">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed">
        <a href="/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../categories/">Categories</a></li>
                <li><a href="../users/login.php?status=true">Login</a></li>
                <li><a rel="nofollow" href="../users/signup.php?status=true">Sign Up</a></li>

                <li>
                    <a rel="nofollow" href="../companies/settings.php?status=true">For companies</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- end of header -->


<div class="container user-connect-page" style="margin-top: 150px;">

    <h1 id="title-container">Login on Vlereso.com</h1>
    <h2>by entering your email and password</h2>

    <div id="tp-login">
    <a href="../1353/fbconfig.php" class="btn btn-facebook"><i class="fa fa-facebook"></i>Log in with Facebook</a><br/><br/>
    <!-- form email -->

    <form id="email-login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <center><input id="login-email" name="login-email" placeholder="Email" class="form-control" tabindex="14" type="text" style="width: 400px;"></center>
    <br />
    <center><input id="login-password" name="login-password" placeholder="Password" class="form-control" tabindex="15" type="Password" style="width: 400px;"></center>
    <br />
    <div class="center">
    <input type="submit" id="login" name="login" class="btn btn-primary btn-signup" tabindex="17" value="Log In"></input>
    </div>

<?php
error_reporting(0);
if (!isset($_SESSION))
{
  @session_start();
}

if(isset($_POST['login']))
{
  include('../pafap_classes/init.php');
  include('../pafap_classes/login_pafap_class.php');
  include('../pafap_classes/templates_pafap_class.php');
  $tmpl = new pafap_templates;
  $login = new pafap_login();

  if($login->isLoggedIn())
    header('location: /');
  else
    $tmpl->show_message($login->showErrors(), 'pafap_error');
}
else
{
  include('../pafap_classes/templates_pafap_class.php');
  $tmpl = new pafap_templates;
  $tmpl->show_message($_SESSION['loginerror'], 'pafap_error');
}

?>

    </form>

    <h2>if you do not have an account click <a href="../users/signup.php?status=true">here</a></h2>
    </div>
</div>
</div>
<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>

