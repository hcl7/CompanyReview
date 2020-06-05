<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vleresoj - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vleresoj - User Settings in vlereso.com</title>
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
      $.post('../controls/logout.php', function() {
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
    $("#ImageUploadForm").ajaxForm({
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
    $('#changepass').click ( function() {
      var oldpass = $('#userPasswordOld').val();
      var newpass = $('#userPasswordNew').val();
      var newpasscomf = $('#userPasswordNewConfirmation').val();
      $.post('chpwd-settings.php', {userPasswordOld:oldpass, userPasswordNew:newpass, userPasswordNewConfirmation:newpasscomf}, function(data){
        $("#changepasswordresult").html(data).hide().fadeIn(2000).fadeOut("slow", function(){});
        location.reload();
      });
	});

    $('#infosave').click ( function() {
      var proftext = $('#userProfileText').val();
      var name = $('#userName').val();
      var city = $('#userCity').val();
      var country = $('#userCountry').val();
      var birth = $('#userBirthYear').val();
      var sex = $('#userGender').val();
      $.post('profile-settings.php', {userProfileText:proftext, userName:name, userCity:city, userCountry:country, userBirthYear:birth, userGender:sex}, function (data){
        $("#saveresults").html(data).hide().fadeIn(2000).fadeOut("slow", function(){
          location.reload();
        });
      });
    });

    $('.profile-edit-list').hide();
    $('#stProfile').click(function(e) {
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

    $('#deleteuser').click ( function(){
      $.post('user-delete.php', function(data){
        $("#deleteuserresult").html(data).hide().fadeIn(3000).fadeOut("slow", function(){});
      });
    });

    $('#email-settings').click (function(){
      $.post('../controls/user-email-settings.php', function(data){
        $("#email-settings-result").html(data).hide().fadeIn(3000).fadeOut("slow", function(){});
      });
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
                <li><a href="../">Home</a></li>
                <li><a href="../categories/">Categories</a></li>
                <?php //error_reporting(0);
                if(!isset($_SESSION)){@session_start();}
                if(!isset($_SESSION['uid'])){
                  //header('location:/');
                  echo ("<script>location.href='../users/login.php?status=true';</script>");
                ?>
                <li><a href="../users/login.php?status=true">Login</a></li>
                <li><a rel="nofollow" href="../users/signup.php?status=true">Sign Up</a></li>
                <?php
                }
                else {
                  $img = $_SESSION['image'];
                  $uid = $_SESSION['uid'];
                  $fname = $_SESSION['fname'];
                  include ('../pafap_classes/init.php');
                  include ('../pafap_classes/bind_pafap_class.php');
                  $bind = new pafap_bind();
                  $usersql = "select * from vlereso_users where uid = '{$uid}'";
                  $userdata = $bind->ArrayResults($usersql);
                  foreach($userdata as $row){
                    $fname = $row["fname"];
                    $lname = $row["lname"];
                    $email = $row["email"];
                    $sex = $row["sex"];
                    $birth = $row["birthday"];
                    $uimg = $row["image"];
                    $location = $row["location"];
                    $locationarr = explode(" ", $location);
                    $text = $row["profiletext"];
                  }
                ?>

                <li class='active'>
                    <a href="#" id="logout-profile-image" class="profile-icon">
                        <img style="border-radius:6px;" src="../<?php echo $img; ?>" id="ProfileImageNav" alt="#" data-username="#" data-userid="#" height="26" width="26">&nbsp;&nbsp;<?php echo $fname; ?>
                    </a>
                    <ul>
                        <li>
                            <a href="../users/index.php?uid=<?php echo $bind->sd($uid); ?>">Profile</a>
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
            <div class="form-group fixed-lg-md">
                <input class="form-control" id="query" name="query" style="border-radius:6px;" type="text" placeholder="Search for websites" autocomplete="off" />
            </div>
        </form>
    </div>
</div>
</div>
<!-- end of header -->
<div class="user-summary-wrapper" style="margin-top:140px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 user-summary-main">
                <div class="user-summary-overview clearfix">
                    <h1 class="headline visible-xs"></h1>

                    <div class="picture">
                        <img id="ProfileImage" class="user-image" src="../<?php echo $uimg; ?>" alt="profile image of <?php echo (empty($fname) && empty($lname))? "User" : $fname.' '.$lname ;?>">
                    </div>

                    <h1 class="headline hidden-xs">
                        <?php echo (empty($fname))? "User" : $fname; ?>'s Profile
                    </h1>

                    <div class="gender-location-wrapper">
                        <div class="gender-js">
                            <?php echo (empty($sex) && empty($birth))? "Sex, Birthday" : $sex.', '.$birth; ?>
                        </div>
                        <div class="location-js">
                            <?php echo (empty($location))? "Locations" : $location; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--end of user profile -->

<?php
if (isset($_SESSION['uid'])){
?>
<div id="userinformation-wrapper" class="userinformation-wrapper clearfix">
<div class="user-summary-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 user-summary-edit-profile" data-userid="56bc9ae80000ff000a052045">

<div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Personal settings<span class="icon-minus circle reversed" id="stProfile"></span></h2>
    <ul class="profile-edit-list expanded">
        <li class="clearfix">
            <ul>
                <li>
                    <form class="ng-pristine ng-valid" id="ImageUploadForm" name="ImageUploadForm" target="UploadTarget" action="user-upload-image.php" method="post" enctype="multipart/form-data">
                        <label>Your profile picture</label>
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
                    <label for="userProfileText">Edit profile text</label>
                    <textarea id="userProfileText" name="userProfileText" class="form-control" rows="3" value="<?php echo $text; ?>"></textarea>
                </li>
                <li class="user-email clearfix">
                    <label>
                        E-mail
                    </label>
                    <label class="user-email-label"><?php echo $email; ?></label>
                </li>
                <li class="clearfix">
                    <label for="userName">
                        Name
                    </label>
                    <input id="userName" name="userName" class="form-control" value="<?php echo $fname." ".$lname ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="userCity">
                        City
                    </label>
                    <input id="userCity" name="userCity" class="form-control" value="<?php echo $locationarr[0]; ?>" type="text">
                </li>
                <li class="clearfix">
                    <label for="userCountry">
                        Country
                    </label>
                    <select class="form-control" id="userCountry" name="userCountry">
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
                    <label for="userBirthYear">
                        Year of birth
                    </label>
                    <select class="form-control" id="userBirthYear" name="userBirthYear"><option value=""></option>
<option value="2016">2016</option>
<option value="2015">2015</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option selected="selected" value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option>
<option value="1934">1934</option>
<option value="1933">1933</option>
<option value="1932">1932</option>
<option value="1931">1931</option>
<option value="1930">1930</option>
<option value="1929">1929</option>
<option value="1928">1928</option>
<option value="1927">1927</option>
<option value="1926">1926</option>
<option value="1925">1925</option>
<option value="1924">1924</option>
<option value="1923">1923</option>
<option value="1922">1922</option>
<option value="1921">1921</option>
<option value="1920">1920</option>
<option value="1919">1919</option>
<option value="1918">1918</option>
<option value="1917">1917</option>
<option value="1916">1916</option>
</select>
                </li>
                <li class="clearfix">
                    <label for="userGender">
                        Gender
                    </label>
                    <select class="form-control" id="userGender" name="userGender"><option selected="selected" value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </li>
                <li class="clearfix">
                    <button type="button" class="btn btn-primary btn-profileinfo btn-profileinfo-js" id="infosave" name="infosave">Save information</button>
                </li>
            </ul>
        </li>
    </ul>
    <div id="saveresults"></div>
</div>
<!-- personal settings -->

<div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Which email notifications do you want to receive?<span class="icon-minus circle reversed" id="stNotification"></span></h2>
    <ul style="height: auto;" class="profile-edit-list2 expanded">
        <li class="alert alert-success notification-message-success-js hidden clearfix">
            Your notification settings have now been changed
        </li>
        <li class="clearfix">
            <input id="userNewsletter" name="userNewsletter" class="form-control" type="checkbox">
            <label for="userNewsletter">News from Vlereso</label>
        </li>
        <li class="clearfix">
            <input id="userLike" name="userLike" class="form-control" checked="checked" type="checkbox">
            <label for="userLike">Someone finds your review useful</label>
        </li>
        <li class="clearfix">
            <button class="btn btn-primary btn-notificationsettings-js" id="email-settings">Save E-mail settings</button>
        </li>
    </ul>
    <div id="email-settings-result"></div>
</div>

                    <div class="profile-edit-list-container">
    <h2 class="profile-edit-heading">Change password<span class="icon-minus circle reversed" id="stChpwd"></span></h2>
    <ul style="height: auto;" class="profile-edit-list3 expanded">
        <li class="clearfix">
            <label for="userPasswordOld">Current password</label>
            <input id="userPasswordOld" name="userPasswordOld" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <label for="txtPassword">
                New password
            </label>
            <input id="userPasswordNew" name="userPasswordNew" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <label for="txtRePassword">
                New password - again
            </label>
            <input id="userPasswordNewConfirmation" name="userPasswordNewConfirmation" class="form-control" value="" type="password">
        </li>
        <li class="clearfix">
            <button class="btn btn-primary btn-changepassword btn-changepassword-js" id="changepass" name="changepass">Change password</button>
        </li>
    </ul>
    <div id="changepasswordresult"></div>
</div>

                    <div class="profile-edit-list-container no-border">
    <h2 class="profile-edit-heading">Delete user<span class="icon-minus circle reversed" id="stDelUser"></span></h2>
    <ul style="height: auto;" class="profile-edit-list4 expanded">
        <li class="clearfix">
            When you delete your user profile, your reviews are deleted as well and can not be restored
        </li>
        <li class="clearfix">
            <button class="btn btn-danger btn-deleteprofile btn-deleteprofile-js" id="deleteuser">Delete my profile</button>
        </li>
    </ul>
    <div id="deleteuserresult"></div>
</div>

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