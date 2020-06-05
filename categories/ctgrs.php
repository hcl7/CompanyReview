<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj Experience the power of customer reviews</title>
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
<link rel="stylesheet" href="../css/stars-style.css" type="text/css" />
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>

<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

<script>
$(document).ready (function(){
  $("#morecompaniesresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
  $("#morecompaniesresults").load('../controls/bindCompany.php', {moreresultscomp:2, jcid:'<?php $cid = $_GET["cid"]; echo $cid; ?>'});

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

    $("#showmorecomp").click( function(){
      $("#morecompaniesresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
      var getmore = parseInt($("#cgetmore").val()) + 2;
      $("#morecompaniesresults").load('../controls/bindCompany.php', {moreresultscomp:getmore, jcid:'<?php $cid = $_GET["cid"]; echo $cid; ?>'});
      $("#cgetmore").val(getmore);
    });

});
</script>
<script type='text/javascript'>
            function review(average, cmpid, rank){
                var rate = Math.round(average);
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = rate; i >= 0; i--) {
                    if(rate == 1){
                        $('.rate-btn-'+cmpid+rank+i).addClass('rate-btn-active');
                        $('#'+cmpid+rank+i).css('background-color', '#900CA4');
                        $('#'+cmpid+rank+i).css('border-radius', '6px');
                    }
                    if(rate == 2){
                        $('.rate-btn-'+cmpid+rank+i).addClass('rate-btn-active');
                        $('#'+cmpid+rank+i).css('background-color', '#57CFE9');
                        $('#'+cmpid+rank+i).css('border-radius', '6px');
                    }
                    if(rate == 3){
                        $('.rate-btn-'+cmpid+rank+i).addClass('rate-btn-active');
                        $('#'+cmpid+rank+i).css('background-color', '#7D9948');
                        $('#'+cmpid+rank+i).css('border-radius', '6px');
                    }
                    if(rate == 4){
                        $('.rate-btn-'+cmpid+rank+i).addClass('rate-btn-active');
                        $('#'+cmpid+rank+i).css('background-color', '#BE5252');
                        $('#'+cmpid+rank+i).css('border-radius', '6px');
                    }
                    if(rate == 5){
                        $('.rate-btn-'+cmpid+rank+i).addClass('rate-btn-active');
                        $('#'+cmpid+rank+i).css('background-color', '#1C93AE');
                        $('#'+cmpid+rank+i).css('border-radius', '6px');
                    }
                };
            }
</script>

</head>
<body>
<!-- start of header -->
<div id="wrapper" class="wrapper">
<div class="ng-scope">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed">
        <a href="/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../categories/index.php?cid=1001">Categories</a></li>
                <?php if(!isset($_SESSION)) {@session_start();} if(!isset($_SESSION['email'])){
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
                    <a href="../companies/signup.php?status=true">For Companies</a>
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

<div class="categories-wrapper container clearfix" style="margin-top: 120px;">

    <input name="categoryUniqueName" value="art" type="hidden">

    <div class="category-menu" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <h2>
        <a href="/categories/index.php?cid=1001" alt="Categories">Categories</a>
    </h2>
    <a href="/categories/index.php?cid=1001" itemprop="url" hidden="">
        <span itemprop="title">Categories</span>
    </a>
    <ul class="category-menu-list">
    <?php
    //error_reporting(0);
    include ('../pafap_classes/init.php');
    include ('../pafap_classes/bind_pafap_class.php');
    $cid = $_GET['cid'];

    $bind = new pafap_bind();
    $tmpl = new pafap_templates;
    $sql = "SELECT cid, cname FROM vlereso_categories";
    $catg = $bind->binder($sql, "cid", "cname");
    $tmpl->showCat($catg);
    $categoryname = $bind->getCatgNameById($cid);
    ?>
    </ul>
</div>

<!-- end of category filter at left side -->


    <div class="category-results">
        <h1>
            Best companies in the category: <?php echo $categoryname;?>
        </h1>
        <?php

        /*$sqlcompbyid = "SELECT distinct vlereso_companies.header, rcompanyid FROM `vlereso_review`, vlereso_companies WHERE vlereso_review.rcompanyid = vlereso_companies.companyid and rcid = '{$bind->sd($cid)}'";
        $datacompany = $bind->ArrayResults($sqlcompbyid);
        $compreview = "select rcompanyid, stars from vlereso_review where rcid = '{$bind->sd($cid)}'";
        $datareview = $bind->ArrayResults($compreview);
        $tmpl->CompanyBinderByCid($datacompany, $datareview, 2); */

        ?>

        <div id="morecompaniesresults"></div>
    <div class="load-more">
        <div id="cmpgetmore">
            <div class="AjaxPagerLinkWrapper">
                <a class="btn btn-primary btn-block btn-lg AjaxPagerLink" id="showmorecomp" href="javascript:void();">
                    Show more companies
                </a>
                <input type="hidden" name="cgetmore" id="cgetmore" value="2" />
            </div>
        </div>
    </div>

    </div>
</div>

<center>&copy;2016 Vlereso, Inc. All rights reserved.</center>
</div>

</body>
</html>