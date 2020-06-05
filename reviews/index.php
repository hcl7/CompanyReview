<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - Reviews</title>

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

<META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="scripts/html5shiv.js"></script>
    <script src="scripts/respond.min.js"></script>
<![endif]-->
<link rel="icon" href="images/favicon.ico">

<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>

<link rel="stylesheet" href="../css/stars-style.css" type="text/css" />
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

<script>
$(document).ready (function(){
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
  var cmpid = getParameterByName('cmpid');
  var ref = getParameterByName('ref');
  if(ref == 0) $('#reference-review').hide();
    $(".user-profile-logout-link").click( function() {
      $.post('../controls/logout.php', function() {
        location.reload();
      });
      return false;
    });

    $("#query").autocomplete({
        source: "../controls/autocomplete.php",
        minLength: 2,//search after two characters
        select: function(event, ui){
          cmpid = ui.item.id;
          location.href = '../companies/index.php?cmpid=' + ui.item.id;
        }
    });

    var stars = 0;
    // rating script
    $(function(){
      $('.rate-btn').hover(function(){
        $('.rate-btn').removeClass('rate-btn-hover');
        var therate = $(this).attr('id');
        for (var i = therate; i >= 0; i--) {
            $('.rate-btn-'+i).addClass('rate-btn-hover');
        };
      });

      $('.rate-btn').click(function(){
        var therate = $(this).attr('id');
        var dataRate = 'rate='+therate;
        $('.rate-btn').removeClass('rate-btn-active');
        for (var i = therate; i >= 0; i--) {
          $('.rate-btn-'+i).addClass('rate-btn-active');
        };
        $('#stars').val(therate);
      });
    });

    $('#reviewform').submit ( function() {
        $('#reviewresult').html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
		$.post('user-review.php', $('#reviewform').serialize(), function(data) {
          $("#reviewresult").html(data).hide().fadeIn(2000).fadeOut("slow", function(){
            location.href = '../companies/index.php?cmpid=' + cmpid;
          });
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
        <a href="../vlereso/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../categories/">Categories</a></li>
                <?php
                error_reporting(0);
                if(!isset($_SESSION)) {@session_start();}
                if(!isset($_SESSION['uid'])){
                  //header('location: ../users/login.php?status=true');
                  echo ("<script>location.href='../users/login.php?status=true';</script>");
                ?>
                <li><a href="../users/login.php?status=true">Login</a></li>
                <li><a rel="nofollow" href="../users/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else {
                  //@session_start();
                  $img = $_SESSION['image'];
                  $uid = $_SESSION['uid'];
                  $fname = $_SESSION['fname'];
                  $companyid = htmlentities(stripslashes($_GET['cmpid']));
                  include ('../pafap_classes/init.php');
                  include ('../pafap_classes/bind_pafap_class.php');

                  $cget = new pafap_mysql();
                  $compsql = "select * from vlereso_companies where companyid = '{$cget->SecureData($companyid)}'";
                  $compdata = $cget->ArrayResults($compsql);
                  foreach($compdata as $row){
                    $compname = $row['header'];
                    $cimg = $row['image'];
                    $cweb = $row['website'];
                    $cemail = $row['email'];
                    $cid = $row['cid'];
                    $subid = $row['subid'];
                  }
                ?>

                <li class='active'>
                    <a href="javascript:void();" id="logout-profile-image" class="profile-icon">
                        <img style="border-radius:6px;" src="../<?php echo $img; ?>" id="ProfileImageNav" alt="#" data-username="#" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $fname; ?>
                    </a>
                    <ul>
                        <li><a href="../users/index.php?uid=<?php echo $uid; ?>">Profile</a></li>
                        <li><a href="../users/settings.php?status=true">Settings</a></li>
                        <li><a href="javascript:void();" class="profile-logout-js user-profile-logout-link">Log Out</a></li>
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
                <input class="form-control" style="border-radius:6px;" type="text" placeholder="Search for websites" id="query" name="query" autocomplete="off" />
            </div>
        </form>
    </div>
</div>
</div>
<!-- end of header -->

<!-- evaluate company -->

<div class="container wrap clearfix" style="margin-top: 120px;">
    <h1>
Voice your opinion! Review <a href="../companies/index.php?cmpid=<?php echo $companyid; ?>"><?php echo $compname; ?></a> now.    </h1>
        <div class="review-form review">
            <div class="overlay"></div>

            <div class="rate-ex1-cnt">
                <div id="1" class="rate-btn-1 rate-btn"></div>
                <div id="2" class="rate-btn-2 rate-btn"></div>
                <div id="3" class="rate-btn-3 rate-btn"></div>
                <div id="4" class="rate-btn-4 rate-btn"></div>
                <div id="5" class="rate-btn-5 rate-btn"></div>
            </div>
            <br /><br />

            <form class="ng-pristine ng-valid" action="<?php ?>" id="reviewform" name="reviewform" method="post">
                <div class="foldout-js">
                    <input type="text" id="reference-review" name="reference-review" class="form-control" placeholder="Put Reference Number Here" style="width: 400px;" /><br />
                    <textarea name="txtReview" class="form-control" id="txtReview" style="width: 400px;" maxlength="10000" placeholder="Share your honest experience, and help others make better choices." tabindex="50"></textarea>
                    <input type="hidden" id="category" name="category" value="<?php echo $cid; ?>" />
                    <input type="hidden" id="subcategory" name="subcategory" value="<?php echo $subid; ?>" />
                    <input type="hidden" id="cemail" name="cemail" value="<?php echo $cemail; ?>" />
                    <input type="hidden" id="reference" name="reference" value="<?php echo $_GET['ref']; ?>" />
                    <input type="hidden" id="cmpid" name="cmpid" value="<?php echo $_GET['cmpid']; ?>" />
                    <input type="hidden" id="stars" name="stars" value="" />
                    <br /><div class="submit-button-js">
                        <button href="#" id="review-button" class="btn btn-primary btn-signup" tabindex="100">Post your review now</button>
                    </div>
                </div>
            </form>
            <br />
            <div id="reviewresult"></div>
        </div>
        <br /><br />
        <div class="review info-col">
            <h2>What is Vlereso?</h2>
            <p>Vlereso is a review community. We help consumers everywhere find companies they can trust.</p>
            <h2>Share your experiences</h2>
            <p>and be a part of our community. It couldn't be easier - with your Vlereso account you can write, edit and share your reviews from one convenient location.</p>

                <h2>How do I get my reference number?</h2>
                <p>We want to ensure that all customers are able to write a review, without exception. If you do not have your reference number, you can send a request to: <a href="mailto:<?php echo $cemail; ?>"><?php echo $cemail; ?></a>. If you are unable to write a review despite having your reference number,  please email us immediately at postmaster@vlereso.com. Please remember to include your order confirmation, so that we can make sure that you're able to review the company without delay.</p>
        </div>
</div>
</div>
<!-- end evaluate  -->

<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>