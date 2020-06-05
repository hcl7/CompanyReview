<?php
@session_start();
if(isset($_SESSION['companyid'])){
  $cuid = $_SESSION['companyid'];
  include ('../pafap_classes/init.php');
  include ('../pafap_classes/bind_pafap_class.php');
  $bind = new pafap_bind();
  $tmpl = new pafap_templates;
  //$bind->deleteCompany($cuid);
  $tmpl->_show("pafap_success", "Comapny Deleted Successfully");
  session_destroy();
  echo ("<script>location.href='../companies/signup.php?status=true';</script>");
}
else echo ("<script>location.href='../companies/login.php?status=true';</script>");


?>