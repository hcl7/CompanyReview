<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - Categories in vlereso.com</title>
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

<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>

<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

<script>
$(document).ready (function(){
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
});
</script>

</head>
<body>
<!-- start of header -->
<div id="wrapper" class="wrapper">
<div class="ng-scope" data-ng-controller="HeaderController as vm">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed">
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
                <li><a href="../users/signup.php?status=true">Sign Up</a></li>
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
                    <a href="../companies/settings.php?status=true">For Companies</a>
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


<div class="categories-wrapper container clearfix" style="margin-top:120px;">

    <div class="category-menu" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <h2>
        <a href="/categories/" alt="Categories">Categories</a>
    </h2>
    <a href="/categories/" itemprop="url" hidden="">
        <span itemprop="title">Categories</span>
    </a>
    <ul class="category-menu-list">
    <?php
    //error_reporting(0);
    include ('../pafap_classes/init.php');
    include ('../pafap_classes/bind_pafap_class.php');
    //$cid = $_GET['cid'];

    $bind = new pafap_bind();
    $tmpl = new pafap_templates;
    $sql = "SELECT cid, cname FROM vlereso_categories";
    $catg = $bind->binder($sql, "cid", "cname");
    $tmpl->showCat($catg);

    ?>

    </ul>
</div>
<!-- end categories -->

<!-- companies by categories -->
    <div class="category-results">
        <h1>
            The best companies in Vlereso business categories
        </h1>
           <?php
        $sqlcatg = "SELECT distinct vlereso_categories.cname, vlereso_categories.sprite, rcid FROM vlereso_review inner join vlereso_categories on vlereso_review.rcid = vlereso_categories.cid";
        $sqlcomp = "SELECT distinct vlereso_companies.header, rcompanyid, rcid FROM vlereso_review
            inner join vlereso_companies on vlereso_review.rcompanyid = vlereso_companies.companyid";
           $sqlreview = "select rcompanyid, stars from vlereso_review";
           $catarr = $bind->ArrayResults($sqlcatg);
           $comparr = $bind->ArrayResults($sqlcomp);
           $review = $bind->ArrayResults($sqlreview);
           $tmpl->CompanyBinder($catarr, $comparr, $review);
           ?>
    </div>
<!-- end of companies by categories -->
</div>
</div>

<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>