<?php
//error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
$tmpl = new pafap_templates;
$bind = new pafap_bind();
if (isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  if($_POST['userName'] != "" && $_POST['userCity'] != "" && $_POST['userCountry'] != "" && $_POST['userBirthYear'] != "" && $_POST['userGender'] != ""){
    $text = $_POST['userProfileText'];
    $name = $_POST['userName'];
    $city = $_POST['userCity'];
    $country = $_POST['userCountry'];
    $birth = $_POST['userBirthYear'];
    $sex = $_POST['userGender'];
    if ($bind->updateProfileInfo($uid, $text, $name, $city, $country, $birth, $sex)){
        $tmpl->_show("pafap_success", "Profile Information Saved!");
    }
    else $tmpl->_show("pafap_error", "Database Error!");
  }
  else $tmpl->_show("pafap_warning", "Fill the Form!");
}
else $tmpl->_show("pafap_error", "Session Error!");
?>