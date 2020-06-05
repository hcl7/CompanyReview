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
if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  if (isset($_POST['userNewsletter'])){
    $useupdatestatus = "UPDATE vlereso_users SET status = 2 WHERE uid = '{$uid}'";
    $bind->ExecuteSQL_Records_Affected($useupdatestatus);
    $tmpl->_show("pafap_success", "Email Settings saved!");
  }
  else {
    $useupdatestatus = "UPDATE vlereso_users SET status = 1 WHERE uid = '{$uid}'";
    $bind->ExecuteSQL_Records_Affected($useupdatestatus);
    $tmpl->_show("pafap_success", "Email Settings saved!");
  }
}
else $tmpl->_show("pafap_error", "Post Error, You must login first!");

?>