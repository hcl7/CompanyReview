<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews - Sign Up by email address">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vlereso Sign Up By Email Address</title>
<META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
<link rel="icon" href="../images/favicon.ico">

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
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />
<link rel="stylesheet" href="../css/social-buttons.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>

<script>
$(document).ready (function(){
    $('#emailsignupform').submit ( function() {
        $('#signupresult').html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
		$.post('user-signup.php', $('#emailsignupform').serialize(), function(data) {
          $("#signupresult").html(data).hide().fadeIn(2000).fadeOut(10000, function(){});
		});
		return false;
	});
});
</script>

</head>
<body>
<?php //var_dump($_POST); ?>
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
                    <a rel="nofollow" href="../companies/signup.php?status=true">For companies</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- end of header -->


<div class="container user-connect-page" style="margin-top: 150px;">

<h1 id="title-container">Sign up on Vlereso.com</h1>
<h2>by entering your email and your full name.</h2>

<div id="tp-login">
    <button class="btn btn-facebook"><i class="fa fa-facebook"></i>Sign Up with Facebook</button><br/><br/>
    <!-- form email -->

    <form id="emailsignupform">
    <center><input id="signupemail" name="signupemail" placeholder="Email" class="form-control" tabindex="14" type="text" style="width: 400px;" /></center>
    <br />
    <center><input id="signupusername" name="signupusername" placeholder="Full Name" class="form-control" tabindex="15" type="text" style="width: 400px;" /></center>
    <div class="signup-accept-terms-container">
    <input id="email-signup-accept-terms" tabindex="16" type="checkbox" name="terms">
    I accept the <a href="#" target="_blank" id="terms-and-conditions">Terms &amp; Conditions</a> and <a href="#" target="_blank" id="privacy-terms">Privacy Policy</a>.
    </div>
    <div class="center">
        <button id="email-signup-button" name="email-signup-button" class="btn btn-primary btn-signup" tabindex="17">Sign up</button>
    </div>
    <div id="signupresult"></div>
    </form>
</div>
</div>
</div>

<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>

