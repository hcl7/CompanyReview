<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - Company Settings in vlereso.com</title>
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

<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>


<script>
$(document).ready (function(){
    $("#user-profile-logout-link").click( function() {
      $.post('../controls/company-logout.php', function() {
        location.reload();
      });
      return false;
    });

    /*upload image */

  $("#uploadresult").hide();
  $("#btn-uploadprofileimage-js").attr("disabled", "disabled");
  $('#upload').live('change', function(){
    $("#uploadresult").show();
    $("#btn-uploadprofileimage-js").attr("disabled", "disabled");
    $("#uploadresult").html('');
    $('#uploadresult').html('<center><img src="../images/loading.gif" alt="Uploading"/></center>');
    $("#cImageUploadForm").ajaxForm({
      target: '#uploadresult'
    }).submit();
  });

    /* end upload image */

    $("#query").autocomplete({
        source: "../controls/autocomplete.php",
        minLength: 2,//search after two characters
        select: function(event, ui){
          location.href = '../companies/index.php?cmpid=' + ui.item.id;
        }
    });

    /* change password */
    $('#cchangepass').click ( function() {
      var oldpass = $('#cmpPasswordOld').val();
      var newpass = $('#cmpPasswordNew').val();
      var newpasscomf = $('#cmpPasswordNewConfirmation').val();
      $.post('company-chpwd-settings.php', {cmpPasswordOld:oldpass, cmpPasswordNew:newpass, cmpPasswordNewConfirmation:newpasscomf}, function(data){
        $("#changepasswordresult").html(data).hide().fadeIn(2000).fadeOut("slow", function(){});
        location.reload();
      });
	});

    $('#cinfosave').click ( function() {
      var desc = $('#cmpProfileText').val();
      var name = $('#cuserName').val();
      var addr = $('#caddress').val();
      var country = $('#cuserCountry').val();
      var web = $('#cwebsite').val();
      var map = $('#cmap').val();
      var ref = $('#creference').val();
      $.post('company-profile-settings.php', {cmpProfileText:desc, cuserName:name, caddress:addr, cuserCountry:country, cwebsite:web, cmap:map, creference:ref}, function (data){
        $("#saveresults").html(data).hide().fadeIn(2000).fadeOut("slow", function(){
          location.reload();
        });
      });
    });

    $('.profile-edit-list').hide();
    $("#stProfile").click(function(e){
      e.preventDefault();
      $('.profile-edit-list').toggle();
      //$("#stProfile").attr('id','stProfileMinus');
    });

    $('.profile-edit-list1').hide();
    $('#stSocial').click(function(e) {
      e.preventDefault();
      $('.profile-edit-list1').toggle();
    });

    $('.profile-edit-list2').hide();
    $('#stNotification').click(function(e) {
      e.preventDefault();
      $('.profile-edit-list2').toggle();
    });

    $('.profile-edit-list3').hide();
    $('#stChpwd').click(function(e) {
      e.preventDefault();
      $('.profile-edit-list3').toggle();
    });

    $('.profile-edit-list4').hide();
    $('#stDelUser').click(function(e) {
      e.preventDefault();
      $('.profile-edit-list4').toggle();
    });

    $('#deletecompany').click( function(){
      $.post('company-delete.php', function(data){
        $("#deletecompanyresult").html(data).hide().fadeIn(2000).fadeOut("slow", function(){});
      });
    });
});
</script>

</head>
<body>
<!-- start of header -->
<div class="ng-scope" data-ng-controller="HeaderController as vm">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed">
        <a href="/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../categories/">Categories</a></li>
                <?php //error_reporting(0);
                if(!isset($_SESSION)){@session_start();}
                if(!isset($_SESSION['companyid'])){
                  echo ("<script>location.href='../companies/login.php?status=true';</script>");
                ?>
                <li><a href="../companies/login.php?status=true">Login</a></li>
                <li><a rel="nofollow" href="../companies/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else {
                  $cimg = $_SESSION['cimage'];
                  $cuid = $_SESSION['companyid'];
                  $cfname = $_SESSION['cfname'];
                  include ('../pafap_classes/init.php');
                  include ('../pafap_classes/bind_pafap_class.php');
                  $bind = new pafap_bind();
                  $compsql = "select * from vlereso_companies where companyid = '{$cuid}'";
                  $compdata = $bind->ArrayResults($compsql);
                  foreach($compdata as $row){
                    $header = $row["header"];
                    $cemail = $row["email"];
                    $cphone = $row["phone"];
                    $web = $row["website"];
                    $uimg = $row["image"];
                    $location = $row["location"];
                    $address = $row["address"];
                    $desc = $row["description"];
                    $refnr = $row["reference_type"];
                    $map = $row["map"];
                  }
                ?>

                <li class='active'>
                    <a href="#" id="logout-profile-image" class="profile-icon">
                        <img class="navbar-profile-image" src="../<?php echo $cimg; ?>" id="ProfileImageNav" alt="#" data-username="#" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $cfname; ?>
                    </a>
                    <ul>
                        <li>
                            <a href="../companies/index.php?cmpid=<?php echo $bind->sd($cuid); ?>">Profile</a>
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
                    <a rel="nofollow" href="../companies/settings.php?status=true">For Companies</a>
                </li>
            </ul>
        </div>
        <form id="tpsearch" method="get" action="#" role="search" class="{ 'align-right':vm.isLoggedIn, 'navbar-form':true }">
            <div class="form-group fixed-lg-md">
                <input class="form-control" id="query" name="query" style="border-radius:6px;" type="text" placeholder="Search for websites" autocomplete="off" />
            </div>
        </form>
    </div>
</div>
</div>
<!-- end of header -->
<div class="user-summary-wrapper" style="margin-top:180px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 user-summary-main">
                <div class="user-summary-overview clearfix">
                    <h1 class="headline visible-xs"></h1>

                    <div class="picture">
                        <a href="http://<?php echo $web; ?>"><img id="ProfileImage" class="user-image" src="../<?php echo $uimg; ?>" alt="profile image of <?php echo (empty($header))? "Company" : $header ;?>"></a>
                    </div>

                    <h1 class="headline hidden-xs">
                        <?php echo (empty($header))? "Company Name" : $header; ?> Company Profile
                    </h1>

                    <div class="gender-location-wrapper">
                        <div class="gender-js">
                            <?php echo (empty($address))? "Company Address:" : $address; ?>
                        </div>
                        <div class="location-js">
                            <?php echo (empty($location))? "Company Location:" : $location; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--end of user profile -->

<?php
if (isset($_SESSION['companyid'])){
?>
<div id="userinformation-wrapper" class="userinformation-wrapper clearfix">
<div class="user-summary-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 user-summary-edit-profile" data-userid="56bc9ae80000ff000a052045">

<div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Company settings<span class="icon-minus circle reversed" id="stProfile"></span></h2>
    <ul class="profile-edit-list expanded">
        <li class="clearfix">
            <ul>
                <li>
                    <form class="ng-pristine ng-valid" id="cImageUploadForm" name="cImageUploadForm" target="UploadTarget" action="company-upload-image.php" method="post" enctype="multipart/form-data">
                        <label>Company profile picture</label>
                        <div class="edit-image-wrapper">
                            <a href="#" class="btn btn-primary btn-uploadprofileimage-js">Upload a new profile picture</a>
                            <input id="upload" class="imageupload" name="upload[]" title="Upload your profile picture" type="file">
                        </div>
                        <label>&nbsp;</label>
                    </form>
                    <div id="uploadresult"></div>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <li class="clearfix">
                    <label for="userProfileText">Company Description</label>
                    <textarea id="cmpProfileText" name="cmpProfileText" class="form-control" rows="3" value="<?php echo $desc; ?>"></textarea>
                </li>
                <li class="user-email clearfix">
                    <label>
                        E-mail
                    </label>
                    <label class="user-email-label"><?php echo $cemail; ?></label>
                </li>
                <li class="clearfix">
                    <label for="userName">
                        Company Name
                    </label>
                    <input id="cuserName" name="cuserName" class="form-control" value="<?php echo $header; ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="address">
                        Address
                    </label>
                    <input id="caddress" name="caddress" class="form-control" value="<?php echo $address; ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="website">
                        Website
                    </label>
                    <input id="cwebsite" name="cwebsite" class="form-control" value="<?php echo $web; ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="map">
                        Google Map
                    </label>
                    <input id="cmap" name="cmap" class="form-control" value="<?php echo $map; ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="reference">
                        Reference Number
                    </label>
                    <input id="creference" name="creference" class="form-control" value="<?php echo $refnr ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="Country">
                        Country
                    </label>
                    <select class="form-control" id="cuserCountry" name="cuserCountry">
<option value="">Choose country</option>
<option value="AF">Afghanistan</option>
<option selected="selected" value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AD">Andorra</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia And Herzegovina</option>
<option value="BR">Brazil</option>
<option value="BN">Brunei</option>
<option value="BG">Bulgaria</option>
<option value="KH">Cambodia</option>
<option value="CA">Canada</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CO">Colombia</option>
<option value="CR">Costa Rica</option>
<option value="HR">Croatia</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FO">Faroe Islands</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GT">Guatemala</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KR">Korea</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao P.D.R.</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao S.A.R.</option>
<option value="MK">Macedonia (FYROM)</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="MT">Malta</option>
<option value="MU">Mauritius</option>
<option value="MX">Mexico</option>
<option value="MN">Mongolia</option>
<option value="MA">Morocco</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NG">Nigeria</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PK">Pakistan</option>
<option value="PS">Palestine</option>
<option value="PA">Panama</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="MC">Principality of Monaco</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="CD">Republic of Congo</option>
<option value="RO">Romania</option>
<option value="RU">Russia</option>
<option value="RW">Rwanda</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="ZA">South Africa</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syria</option>
<option value="TW">Taiwan</option>
<option value="TH">Thailand</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="AE">U.A.E.</option>
<option value="UA">Ukraine</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UY">Uruguay</option>
<option value="VE">Venezuela</option>
<option value="VN">Vietnam</option>
<option value="YE">Yemen</option>
<option value="ZW">Zimbabwe</option>
</select>
                </li>
                <li class="clearfix">
                    <button type="button" class="btn btn-primary btn-profileinfo btn-profileinfo-js" id="cinfosave" name="cinfosave">Save information</button>
                </li>
            </ul>
        </li>
    </ul>
    <div id="saveresults"></div>
</div>
<!-- personal settings -->

                    <div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">My Social Settings<span class="icon-minus circle reversed" id="stSocial"></span></h2>
    <ul style="height: auto;" class="profile-edit-list1 expanded">
        <li class="clearfix">
                <div id="tp-connect-container">Facebook</div>
        </li>
    </ul>
</div>

                    <div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Which email notifications do you want to receive?<span class="icon-minus circle reversed" id="stNotification"></span></h2>
    <ul style="height: auto;" class="profile-edit-list2 expanded">
        <li class="alert alert-success notification-message-success-js hidden clearfix">
            Your notification settings have now been changed
        </li>
        <li class="clearfix">
            <input id="cmpNewsletter" name="cmprNewsletter" class="form-control" type="checkbox">
            <label for="cmpNewsletter">News from Vlereso</label>
        </li>
        <li class="clearfix">
            <input id="userLike" name="userLike" class="form-control" checked="checked" type="checkbox">
            <label for="userLike">Someone finds your review useful</label>
        </li>
        <li class="clearfix">
            <button class="btn btn-primary btn-notificationsettings-js">Save E-mail settings</button>
        </li>
    </ul>
</div>

                    <div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Change password<span class="icon-minus circle reversed" id="stChpwd"></span></h2>
    <ul style="height: auto;" class="profile-edit-list3 expanded">
        <li class="clearfix">
            <label for="cmpPasswordOld">Current password</label>
            <input id="cmpPasswordOld" name="cmpPasswordOld" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <label for="txtPassword">
                New password
            </label>
            <input id="cmpPasswordNew" name="cmpPasswordNew" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <label for="txtRePassword">
                New password - again
            </label>
            <input id="cmpPasswordNewConfirmation" name="cmpPasswordNewConfirmation" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <button class="btn btn-primary btn-changepassword btn-changepassword-js" id="cchangepass" name="cchangepass">Change password</button>
        </li>
    </ul>
    <div id="changepasswordresult"></div>
</div>

                    <div class="profile-edit-list-container no-border">
    <h2 class="profile-edit-heading">Delete Company Account<span class="icon-minus circle reversed" id="stDelUser"></span></h2>
    <ul style="height: auto;" class="profile-edit-list4 expanded">
        <li class="clearfix">
            When you delete your company profile, your reviews are deleted as well and can not be restored
        </li>
        <li class="clearfix">
            <button class="btn btn-danger btn-deleteprofile cbtn-deleteprofile-js" id="deletecompany">Delete my Company Account</button>
        </li>
    </ul>
    <div id="deletecompanyresult"></div>
</div>

                </div>
            </div>
        </div>
    </div>
    </div>
<?php } ?>

<center><div>&copy;2016 Vlereso, Inc. All rights reserved.</div></center>

</body>
</html>