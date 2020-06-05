<?php
if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  include ('../pafap_classes/init.php');
  include ('../pafap_classes/bind_pafap_class.php');
  $bind = new pafap_bind();
  $tmpl = new pafap_templates;
  //$bind->deleteUser($uid);
  $tmpl->_show("pafap_success", "User Deleted Successfully");
  session_destroy();
  echo ("<script>location.href='../users/signup.php?status=true';</script>");
}
else echo ("<script>location.href='../users/login.php?status=true';</script>");


?>