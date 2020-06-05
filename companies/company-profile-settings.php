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
if (isset($_SESSION['companyid'])){
  $cuid = $_SESSION['companyid'];
  if($_POST['cuserName'] != "" && $_POST['caddress'] != "" && $_POST['cwebsite'] != "" && $_POST['cmap'] != "" && $_POST['cuserCountry'] != ""){
    $desc = $_POST['cmpProfileText'];
    $name = $_POST['cuserName'];
    $addr = $_POST['caddress'];
    $web = $_POST['cwebsite'];
    $map = $_POST['cmap'];
    $reft = $_POST['creference'];
    $country = $_POST['cuserCountry'];
    if ($bind->updateCompanyProfileInfo($cuid, $desc, $name, $addr, $web, $map, $reft, $country)){
        $tmpl->_show("pafap_success", "Company Profile Information Saved!");
    }
    else $tmpl->_show("pafap_error", "Database Error!");
  }
  else $tmpl->_show("pafap_warning", "Fill the Form!");
}
else $tmpl->_show("pafap_warning", "Session Error!");
?>