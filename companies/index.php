<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vlereso - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vlereso Companies</title>
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
  $("#moreusersbycompanyidresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
  $("#moreusersbycompanyidresults").load('../controls/bindUsersReviewByCompanyId.php', {moreresultsusersbycompanyid:2, jcmpid:'<?php $companyid = htmlentities(stripslashes($_GET["cmpid"])); echo $companyid; ?>'});

    $("#user-profile-logout-link").click( function() {
      $.post('../controls/company-logout.php', function() {
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


    $("#showmoreusers").click( function(){
      $("#moreusersbycompanyidresults").html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
      var getmore = parseInt($("#ugetmore").val()) + 2;
      $("#moreusersbycompanyidresults").load('../controls/bindUsersReviewByCompanyId.php', {moreresultsusersbycompanyid:getmore, jcmpid:'<?php $companyid = htmlentities(stripslashes($_GET["cmpid"])); echo $companyid; ?>'});
      $("#ugetmore").val(getmore);
    });


});
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
                <li><a href="../categories/">Categories</a></li>
                <?php if(!isset($_GET['cmpid'])) $_GET['cmpid'] = 0;
                      if(!isset($_SESSION)) {@session_start();}
                      if(!isset($_SESSION['companyid'])){
                        $companyid = htmlentities(stripslashes($_GET['cmpid']));
                        include ('../pafap_classes/init.php');
                        include ('../pafap_classes/bind_pafap_class.php');

                        $cget = new pafap_bind();
                        //company query
                        $compsql = "select * from vlereso_companies where companyid = '{$cget->SecureData($companyid)}'";
                        $compdata = $cget->ArrayResults($compsql);
                        foreach($compdata as $row){
                          $compname = $row['header'];
                          $cimg = $row['image'];
                          $cweb = $row['website'];
                          $ref = $row['reference_type'];
                          if (empty($ref)) $ref = 0;
                          $desc = $row['description'];
                          $cemail = $row['email'];
                          $phone = $row['phone'];
                          $addr = $row['address'];
                          $location = $row['location'];
                        }

                        //counting stars
                        $sql = "select rcompanyid, stars from vlereso_review";
                        $data = $cget->ArrayResults($sql);
                        $star1 = $cget->averageStars($data, $cget->SecureData($companyid), 1);
                        $star2 = $cget->averageStars($data, $cget->SecureData($companyid), 2);
                        $star3 = $cget->averageStars($data, $cget->SecureData($companyid), 3);
                        $star4 = $cget->averageStars($data, $cget->SecureData($companyid), 4);
                        $star5 = $cget->averageStars($data, $cget->SecureData($companyid), 5);

                        $nreview = $cget->countReviews($data, $cget->SecureData($companyid));
                        $average = ($nreview == 0)? $nreview = 1 : ($star1 * 1 + $star2 * 2 + $star3 * 3 + $star4 * 4 + $star5 * 5) / $nreview;
                        $percent1 = ($nreview == 0)? $nreview = 1 : $star1 / $nreview;
                        $percent2 = ($nreview == 0)? $nreview = 1 : $star2 / $nreview;
                        $percent3 = ($nreview == 0)? $nreview = 1 : $star3 / $nreview;
                        $percent4 = ($nreview == 0)? $nreview = 1 : $star4 / $nreview;
                        $percent5 = ($nreview == 0)? $nreview = 1 : $star5 / $nreview;

                        $result = $cget->averageResult($average);

                ?>
                <li><a href="../companies/login.php?status=true">Login</a></li>
                <li><a href="../companies/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else {
                  @session_start();
                  $cimg = $_SESSION['cimage'];
                  $cuid = $_SESSION['companyid'];
                  $cfname = $_SESSION['cfname'];
                  $companyid = htmlentities(stripslashes($_GET['cmpid']));
                  include ('../pafap_classes/init.php');
                  include ('../pafap_classes/bind_pafap_class.php');

                  $cget = new pafap_bind();
                  $compsql = "select * from vlereso_companies where companyid = '{$cget->SecureData($companyid)}'";
                  $compdata = $cget->ArrayResults($compsql);
                  foreach($compdata as $row){
                    $compname = $row['header'];
                    $cimg = $row['image'];
                    $cweb = $row['website'];
                    $ref = $row['reference_type'];
                    if (empty($ref)) $ref = 0;
                    $desc = $row['description'];
                    $cemail = $row['email'];
                    $phone = $row['phone'];
                    $addr = $row['address'];
                    $location = $row['location'];
                  }

                  $sql = "select rcompanyid, stars from vlereso_review";
                  $data = $cget->ArrayResults($sql);
                  $star1 = $cget->averageStars($data, $cget->SecureData($companyid), 1);
                  $star2 = $cget->averageStars($data, $cget->SecureData($companyid), 2);
                  $star3 = $cget->averageStars($data, $cget->SecureData($companyid), 3);
                  $star4 = $cget->averageStars($data, $cget->SecureData($companyid), 4);
                  $star5 = $cget->averageStars($data, $cget->SecureData($companyid), 5);

                  $nreview = $cget->countReviews($data, $cget->SecureData($companyid));

                  $average = ($nreview == 0)? $nreview = 1 : ($star1 * 1 + $star2 * 2 + $star3 * 3 + $star4 * 4 + $star5 * 5) / $nreview;
                  $percent1 = ($nreview == 0)? $nreview = 1 : $star1 / $nreview;
                  $percent2 = ($nreview == 0)? $nreview = 1 : $star2 / $nreview;
                  $percent3 = ($nreview == 0)? $nreview = 1 : $star3 / $nreview;
                  $percent4 = ($nreview == 0)? $nreview = 1 : $star4 / $nreview;
                  $percent5 = ($nreview == 0)? $nreview = 1 : $star5 / $nreview;

                  $result = $cget->averageResult($average);

                ?>

                <li class='active'>
                    <a href="javascript:void();" id="logout-profile-image">
                        <img style="border-radius:6px;" class="navbar-profile-image" src="../<?php echo $cimg; ?>" id="ProfileImageNav" alt="User Profile" data-username="User Profile" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $cfname; ?>
                    </a>
                    <ul>
                        <li>
                            <a href="../companies/index.php?cmpid=<?php echo $cuid; ?>">Profile</a>
                        </li>
                        <li>
                            <a href="../companies/settings.php?status=true">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:void();" id="user-profile-logout-link">Log Out</a>
                        </li>
                    </ul>
                </li>
                <?php
                }?>
                <li>
                    <a href="../companies/settings.php?status=true">For companies</a>
                </li>
            </ul>
        </div>
        <form id="tpsearch" method="get" action="#" role="search">
            <div class="form-group">
                <input class="form-control" style="border-radius:6px;" type="text" placeholder="Search for websites" name="query" id="query" autocomplete="off" />
                <!--<button class="icon-search" type="submit"></button>-->
            </div>
        </form>
    </div>
</div>
</div>

<!-- end of header -->

<!-- container body -->
<div itemscope="" itemtype="http://schema.org/LocalBusiness" id="companyinformation-wrapper" class="companyinformation-wrapper clearfix" data-locale="en-US" style="margin-top:120px;">

<div class="company-summary-wrapper">

<!-- script chart -->
<script type="text/javascript">
window.onload = function () {
  var rate = '<?php echo round($average); ?>';
  $('.rate-btn').removeClass('rate-btn-active');
  for (var i = rate; i >= 0; i--) {
    if(rate == 1){
    $('.rate-btn-'+i).addClass('rate-btn-active');
    $('#'+i).css('background-color', '#900CA4');
    }
    else if(rate == 2){
    $('.rate-btn-'+i).addClass('rate-btn-active');
    $('#'+i).css('background-color', '#57CFE9');
    }
    else if(rate == 3){
    $('.rate-btn-'+i).addClass('rate-btn-active');
    $('#'+i).css('background-color', '#7D9948');
    }
    else if(rate == 4){
    $('.rate-btn-'+i).addClass('rate-btn-active');
    $('#'+i).css('background-color', '#BE5252');
    }
    else if(rate == 5){
    $('.rate-btn-'+i).addClass('rate-btn-active');
    $('#'+i).css('background-color', '#1C93AE');
    }
    else {
      $('.rate-btn-'+i).css('display', 'none');
      $('#'+i).css('display', 'none');
    }
  };
    var star5 = '<?php echo number_format($percent5, 2, '.', '') ?>';
    var star4 = '<?php echo number_format($percent4, 2, '.', '') ?>';
    var star3 = '<?php echo number_format($percent3, 2, '.', '') ?>';
    var star2 = '<?php echo number_format($percent2, 2, '.', '') ?>';
    var star1 = '<?php echo number_format($percent1, 2, '.', '') ?>';

	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Vlereso Chart Reviews"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 10,
			fontFamily: "Helvetica"
		},
		theme: "theme1",
		data: [
		{
			type: "pie",
			indexLabelFontFamily: "Garamond",
			indexLabelFontSize: 10,
			indexLabel: "{label} {y}%",
			startAngle:-10,
			showInLegend: true,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [
				{  y: star5, legendText:"5 Stars", label: "5 Stars" },
				{  y: star4, legendText:"4 Stars", label: "4 Stars" },
				{  y: star3, legendText:"3 Stars", label: "3 Stars" },
				{  y: star2, legendText:"2 Stars", label: "2 Stars" },
				{  y: star1, legendText:"1 Star", label: "1 Star" }
			]
		}
		]
	});
	chart.render();
}
</script>
<script type="text/javascript" src="../scripts/canvasjs.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-8 company-summary-main">


                <div class="company-summary-overview clearfix">

                    <div class="table-view">
                        <div class="picture">
                            <a class="company-screenshot-link-js" itemprop="url" href="http://<?php echo $cweb; ?>" rel="nofollow" target="_blank" title="<?php echo $compname; ?>">
                                <img itemprop="image" class="company-screenshot" src="../<?php echo $cimg; ?>" alt="<?php echo $compname; ?>">
                            </a>
                        </div>

                        <h1 class="headline">
                            <span itemprop="name"><?php echo $compname; ?></span> reviews
                        </h1>
                    </div>

                    <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating" class="rating summary-rating" title="<?php ?> is based on <?php ?> reviews.">
                            <div class="word-rating">
<?php echo $result; ?>                                    <div class="number-rating">
                                        <span class="average" itemprop="ratingValue"><?php echo $average; ?></span>
                                    </div>
                                    <span class="max-rating">from <span itemprop="worstRating">1</span> - <span itemprop="bestRating">5</span></span>
                            </div>


<div class="star-rating">
    <div class="rate-ex1-cnt">
        <div id="1" class="rate-btn-1 rate-btn"></div>
        <div id="2" class="rate-btn-2 rate-btn"></div>
        <div id="3" class="rate-btn-3 rate-btn"></div>
        <div id="4" class="rate-btn-4 rate-btn"></div>
        <div id="5" class="rate-btn-5 rate-btn"></div>
    </div>
</div>&nbsp;&nbsp;&nbsp; <a id="ReviewButton" href="../reviews/index.php?cmpid=<?php echo $cget->SecureData($companyid); ?>&ref=<?php echo ($cget->SecureData($ref))? md5($cget->SecureData($ref)) : $cget->SecureData($ref); ?>" title="Post a review of <?php echo $compname; ?>" class="btn btn-primary btn-lg btn-custom js-has-not-rated" data-user-has-rated="False" data-edit-review-text="Edit review">
                                Vlereso Tani
                            </a>
                            <div class="stats-recency-wrapper">

                                <div class="stats">
                                    <span itemprop="reviewCount" class="ratingCount"><?php echo $nreview; ?></span> reviews on Vlereso
                                </div>

                            </div>
                    </div>
                </div>
            </div>

            <div id="chartContainer" style="height: 160px; width: 40%;">
    </div>
</div>
<br />

</div>
</div>
<!-- end container body -->

<?php
/*$tmpl = new pafap_templates;
$sqlusersreview = "SELECT vlereso_users.fname, vlereso_companies.header, ruid, stars, vlereso_review.date_created, rnotes FROM vlereso_users, vlereso_companies, vlereso_review WHERE vlereso_users.uid = vlereso_review.ruid AND vlereso_companies.companyid = vlereso_review.rcompanyid AND rcompanyid = '{$cget->SecureData($companyid)}'";
$datausersreview = $cget->ArrayResults($sqlusersreview);
$tmpl->usersReviewByCompanyID($datausersreview, $companyid, 2);*/
?>
<div id="moreusersbycompanyidresults"></div>
<center><div style="width: 50%;">
        <div id="cmpgetmore">
            <div class="AjaxPagerLinkWrapper">
                <a class="btn btn-primary btn-block btn-lg AjaxPagerLink" id="showmoreusers" href="javascript:void();">
                    Show more user reviews
                </a>
                <input type="hidden" name="ugetmore" id="ugetmore" value="2" />
            </div>
        </div>
    </div></center>

<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>
</div>
</div>

</body>
</html>

