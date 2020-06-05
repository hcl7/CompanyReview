<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - Activate your Account</title>
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

<link rel="stylesheet" href="../css/social-buttons.css" type="text/css" />
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>

<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

<?php ?>
<script>
$(document).ready (function(){
    //alert("test");
    $('#activateform').submit ( function(){
        $('#activateresult').html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
        $.post('user-activate.php', $('#activateform').serialize(), function(data) {
            $("#activateresult").html(data).hide().fadeIn(2000).fadeOut(3000);
        });
        return false;
    });
});
</script>

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
                <li><a href="../categories/">Categories</a></li>
                <li>
                    <a href="../companies/signup.php?status=true">For Companies</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- end of header -->


<div class="container user-connect-page" style="margin-top: 150px;">

    <h1 id="title-container"><?php echo base64_decode($_GET['name']); ?></h1>

    <h2>Thank you for chosing www.vlereso.com to advertise your Web site</h2><br />
    <h3>Activate your Account on Vlereso.com</h3>
    <h3>by entering your password</h3>

    <div id="tp-login">
    <!-- form email -->

    <form id="activateform">
    <center><input id="passwordlogin" name="passwordlogin" placeholder="Password" class="form-control" tabindex="14" type="Password" style="width: 400px;"></center>
    <br />
    <center><input id="reenterpasswordlogin" name="reenterpasswordlogin" placeholder="Re-Enter Password" class="form-control" tabindex="15" type="Password" style="width: 400px;"></center>
    <div class="signup-accept-terms-container">
    <input type="hidden" name="email-active" value="<?php echo $_GET['email']; ?>" />
    <input type="hidden" name="name-active" value="<?php echo $_GET['name']; ?>" />
    </div><br />
    <div class="center">
    <button id="activate-button" class="btn btn-primary btn-signup" tabindex="17">Activate Now</button>
    </div>
    </form>
    <?php //$var = $_POST['passwordlogin'];  ?>
    <br />
    <div id="activateresult"></div>
    </div>
</div>
</div>
<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>

