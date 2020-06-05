<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - User Profile in vlereso.com</title>
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

<meta name="msapplication-TileColor" content="#000000">
<meta name="msapplication-navbutton-color" content="#292929">
<meta name="application-name" content="Vlereso">

<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>
<link rel="stylesheet" href="../css/styles.css" type="text/css" />

<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

<script>
$(document).ready (function(){
  $("#morecompanybyuidresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
  $("#morecompanybyuidresults").load('../controls/bindCompanyByUid.php', {moreresultsusersbycompanyid:2, juid:'<?php $guid = htmlentities(stripslashes($_GET["uid"])); echo $guid; ?>'});

    $("#user-profile-logout-link").click( function() {
      $.post('../controls/logout.php', function() {
        location.reload();
      });
      return false;
    });

    $("#query").autocomplete({
        source: "../controls/autocomplete.php",
        minLength: 2,//search after two characters
        select: function(event, ui){
          location.href = '../companies/index.php?cmpid=' + ui.item.id;
        }
    });

    $("#showmorecompbyuid").click( function(){
      $("#morecompanybyuidresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
      var getmore = parseInt($("#usrgetmore").val()) + 2;
      $("#morecompanybyuidresults").load('../controls/bindCompanyByUid.php', {moreresultsusersbycompanyid:getmore, juid:'<?php $guid = htmlentities(stripslashes($_GET["uid"])); echo $guid; ?>'});
      $("#usrgetmore").val(getmore);
    });

});
</script>
</head>
<body>
<!-- start of header -->
<div id="wrapper" class="wrapper">
<div class="ng-scope">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed" style="margin-top:4px;">
        <a href="/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../categories/">Categories</a></li>
                <?php if(!isset($_SESSION)) {@session_start();} if(!isset($_SESSION['uid'])){
                ?>
                <li><a href="../users/login.php?status=true">Login</a></li>
                <li><a rel="nofollow" href="../users/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else {  $img = $_SESSION['image']; $uid = $_SESSION['uid']; $fname = $_SESSION['fname'];
                ?>

                <li class='active'>
                    <a href="javascript:void();" id="logout-profile-image" class="profile-icon">
                        <img style="border-radius:6px;" src="../<?php echo $img; ?>" id="ProfileImageNav" alt="#" data-username="#" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $fname; ?>
                    </a>
                    <ul>
                        <li>
                            <a href="../users/index.php?uid=<?php echo $uid; ?>">Profile</a>
                        </li>
                        <li>
                            <a href="../users/settings.php?status=true">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:void();" id="user-profile-logout-link">Log Out</a>
                        </li>
                    </ul>
                </li>
                <?php
                }?>
                <li>
                    <a rel="nofollow" href="../companies/signup.php?status=true">For Companies</a>
                </li>
            </ul>
        </div>
        <form id="tpsearch" method="get" action="#" role="search" class="{ 'align-right':vm.isLoggedIn, 'navbar-form':true }">
            <div class="form-group">
                <input class="form-control" id="query" name="query" style="border-radius:6px;" type="text" placeholder="Search for websites" autocomplete="off" />
            </div>
        </form>
    </div>
</div>
</div>
<!-- end of header -->
<?php
$guid = htmlentities(stripslashes($_GET['uid']));
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
$bind = new pafap_bind();
$usersql = "select * from vlereso_users where uid = '{$bind->sd($guid)}'";
$userdata = $bind->ArrayResults($usersql);
foreach($userdata as $row){
  $fname = $row["fname"];
  $lname = $row["lname"];
  $sex = $row["sex"];
  $birth = $row["birthday"];
  $uimg = $row["image"];
  $location = $row["location"];
}
?>
<div itemscope="" itemtype="http://schema.org/LocalBusiness" id="companyinformation-wrapper" class="companyinformation-wrapper clearfix" data-locale="en-US" style="margin-top:140px;">
<div class="company-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 user-summary-main">
                <div class="user-summary-overview clearfix">
                    <h1 class="headline visible-xs"></h1>

                    <div class="picture">
                        <img id="ProfileImage" class="user-image" src="../<?php echo $uimg; ?>" alt="profile image of <?php echo $fname.' '. $lname;?>">
                    </div>

                    <h1 class="headline">
                        <?php echo $fname; ?>'s Profile
                    </h1>

                    <div class="gender-location-wrapper">
                        <div class="gender-js">
                            <?php echo (empty($sex) && empty($birth))? "Sex, Birthday" : $sex.', '.$birth; ?>
                        </div>
                        <div class="location-js">
                            <?php echo (empty($location))? "Location" : $location; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of user profile -->
    <?php
    /*$tmpl = new pafap_templates;
    $datausersql = "select vlereso_companies.header, vlereso_companies.companyid, vlereso_review.date_created, rnotes, stars from vlereso_review, vlereso_companies where vlereso_review.rcompanyid = vlereso_companies.companyid and vlereso_review.ruid = '{$bind->sd($guid)}'";
    $datausersprof = $bind->ArrayResults($datausersql);
    $tmpl->companyBinderByUid($datausersprof, 2);*/
    ?>
    <div id="morecompanybyuidresults"></div>
    <center>
        <div style="width: 50%;">
        <div id="cmpgetmore">
            <div class="AjaxPagerLinkWrapper">
                <a class="btn btn-primary btn-block btn-lg AjaxPagerLink" id="showmorecompbyuid" href="javascript:void();">
                    Show More
                </a>
                <input type="hidden" name="usrgetmore" id="usrgetmore" value="2" />
            </div>
        </div>
        </div>
    </center>

<center><div>&copy; 2016 Vlereso, Inc. All rights reserved.</div></center>
</div>
</div>
</body>
</html>