<!DOCTYPE html>
<html lang="en-US">
<head>


<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<![endif]-->

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

<title>Vlereso Experience the power of customer reviews</title>
<META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="scripts/html5shiv.js"></script>
    <script src="scripts/respond.min.js"></script>
<![endif]-->
<link rel="icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/minsources.css" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<script src="scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="scripts/script.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>

<style>
#carousel {
  position: relative;
  width: 100%;
  margin: 0 auto;
}

#slides {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 350px;
}

#slides ul {
  list-style: none;
  width: 100%;
  height: 250px;
  margin: 0;
  padding: 0;
  position: relative;
}

#slides li {
  width: 100%;
  height: 250px;
  float: left;
  text-align: center;
  position: relative;
  font-family: lato, sans-serif;
}

/* Styling for prev and next buttons */

.btn-bar {
  width: 60%;
  margin: 0 auto;
  display: block;
  position: relative;
  top: 0px;
}

#buttons {
  padding: 0 0 5px 0;
  float: right;
}

#buttons a {
  text-align: center;
  display: block;
  font-size: 50px;
  float: left;
  outline: 0;
  margin: 0 60px;
  color: #b14943;
  text-decoration: none;
  display: block;
  padding: 9px;
  width: 35px;
}

a#prev:hover,
a#next:hover {
  color: #FFF;
  text-shadow: .5px 0px #b14943;
}

.quote-phrase,
.quote-author {
  font-family: sans-serif;
  font-weight: 300;
  display: table-cell;
  vertical-align: middle;
  padding: 5px 20px;
  font-family: 'Lato', Calibri, Arial, sans-serif;
}

.quote-phrase {
  height: 60px;
  font-size: 24px;
  color: #b14943;
  font-style: italic;
  /*text-shadow: 4px 4px #b14943;*/
}

.quote-marks {
  font-size: 30px;
  padding: 0 3px 3px;
  position: inherit;
}

.quote-author {
  font-style: normal;
  font-size: 20px;
  color: #b14943;
  font-weight: 400;
  height: 30px;
}

.quoteContainer,
.authorContainer {
  display: table;
  width: 100%;
}
</style>
<script>
$(document).ready (function(){
    $("#user-profile-logout-link").click( function() {
      $.post('controls/logout.php', function() {
        location.reload();
      });
      return false;
    });

    $("#query").autocomplete({
        source: "controls/autocomplete.php",
        minLength: 2,//search after two characters
        select: function(event,ui){
          //alert(ui.item.id);
          location.href = 'companies/index.php?cmpid=' + ui.item.id;
        }
    });
});
</script>

</head>
<body style="background-image: url(images/review.jpg); background-size: 100%; background-repeat: no-repeat;">
<div id="wrapper" class="wrapper">
<!-- start of header -->
<div class="ng-scope" style="background: #292929;">
    <div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper">
        <a href="../" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="categories/">Categories</a></li>
                <?php if(!isset($_SESSION)) {@session_start();}
                      if(!isset($_SESSION['uid'])){
                ?>
                <li><a href="../users/login.php?status=true">Login</a></li>
                <li><a href="../users/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else { @session_start(); $img = $_SESSION['image']; $uid = $_SESSION['uid']; $fname = $_SESSION['fname'];
                ?>

                <li class='active'>
                    <a href="javascript:void();" id="logout-profile-image">
                        <img style="border-radius:6px;" src="<?php echo $img; ?>" id="ProfileImageNav" alt="User Profile" data-username="User Profile" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $fname; ?>
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
                <li class="">
                    <a rel="nofollow" href="../companies/settings.php?status=true">For Companies</a>
                </li>
            </ul>
        </div>
                <form id="tpsearch" method="get" action="#" role="search" class="{ 'align-right':vm.isLoggedIn, 'navbar-form':true }">
                    <div class="form-group">
                        <input class="form-control" style="border-radius:6px;" type="text" placeholder="Search for websites" name="query" id="query" autocomplete="off" />
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- end of header -->
<div itemscope="" itemtype="http://schema.org/LocalBusiness" id="companyinformation-wrapper" class="companyinformation-wrapper clearfix" data-locale="en-US" style="margin-top:120px;">
<div class="company-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-8 company-summary-main"></div>
        </div>
<!-- slide -->
<div id="carousel">
  <div class="btn-bar">
    <div id="buttons"><a id="prev" href="#"></a><a id="next" href="#"></a> </div>
  </div>
  <div id="slides">
    <ul>
<?php
include ('pafap_classes/init.php');
include ('pafap_classes/bind_pafap_class.php');
$tmpl = new pafap_templates;
$cget = new pafap_bind();
$sqlusersreview = "SELECT vlereso_users.fname, vlereso_users.image, vlereso_companies.header, ruid, stars, vlereso_review.date_created, rnotes FROM vlereso_users inner join vlereso_review on vlereso_users.uid = vlereso_review.ruid inner join vlereso_companies on vlereso_companies.companyid = vlereso_review.rcompanyid ORDER BY vlereso_review.date_created DESC";
$datausersreview = $cget->ArrayResults($sqlusersreview);
$tmpl->allUsersReview($datausersreview);
?>
    </ul>
  </div>
</div>
<!-- end of slide -->
<script>
$(document).ready(function () {
    //rotation speed and timer
    var speed = 5000;

    var run = setInterval(rotate, speed);
    var slides = $('.slide');
    var container = $('#slides ul');
    var elm = container.find(':first-child').prop("tagName");
    var item_width = container.width();
    var previous = 'prev'; //id of previous button
    var next = 'next'; //id of next button
    slides.width(item_width); //set the slides to the correct pixel width
    container.parent().width(item_width);
    container.width(slides.length * item_width); //set the slides container to the correct total width
    container.find(elm + ':first').before(container.find(elm + ':last'));
    resetSlides();


    //if user clicked on prev button

    $('#buttons a').click(function (e) {
        //slide the item

        if (container.is(':animated')) {
            return false;
        }
        if (e.target.id == previous) {
            container.stop().animate({
                'left': 0
            }, 1500, function () {
                container.find(elm + ':first').before(container.find(elm + ':last'));
                resetSlides();
            });
        }

        if (e.target.id == next) {
            container.stop().animate({
                'left': item_width * -2
            }, 1500, function () {
                container.find(elm + ':last').after(container.find(elm + ':first'));
                resetSlides();
            });
        }

        //cancel the link behavior
        return false;

    });

    //if mouse hover, pause the auto rotation, otherwise rotate it
    container.parent().mouseenter(function () {
        clearInterval(run);
    }).mouseleave(function () {
        run = setInterval(rotate, speed);
    });


    function resetSlides() {
        //and adjust the container so current is in the frame
        container.css({
            'left': -1 * item_width
        });
    }

});

function rotate() {
    $('#next').click();
}
</script>

            </div>
        </div>

    </div>
<?php //echo 'user:='.$_SESSION['uid']; ?>
<!-- end container body -->
</div>
<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>