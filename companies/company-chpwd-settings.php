<?php
//error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
include ('../mailer/sender-class.php');
$tmpl = new pafap_templates;
$bind = new pafap_bind();
if (isset($_SESSION['companyid'])){
  $uid = $_SESSION['companyid'];
  if($_POST['cmpPasswordOld'] != "" && $_POST['cmpPasswordNew'] != "" && $_POST['cmpPasswordNewConfirmation'] != ""){
    $old = $_POST['cmpPasswordOld'];
    $pass = $_POST['cmpPasswordNew'];
    $repass = $_POST['cmpPasswordNewConfirmation'];
    if ($bind->checkCompanyPass($old, $uid)){
      if (strcmp($pass, $repass) == 0){
        $bind->changeCompanyPassword($pass, $uid);
        $tmpl->_show("pafap_success", "Password Is Changed Successfully");
      }
      else $tmpl->_show("pafap_warning", "New Password Is Not The Save with Re Enter password!");
    }
    else $tmpl->_show("pafap_error", "Old Password Is Invalid!");
  }
  else $tmpl->_show("pafap_error", "Post Error!");
}
else $tmpl->_show("pafap_warning", "Session Error!");
?>