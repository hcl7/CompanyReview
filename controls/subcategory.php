<?php
//error_reporting(0);
//session_start();

if(isset($_POST['catid']))
{
  $catid = $_POST['catid'];
  //$_SESSION['catid'] = $catid;
  include ('../pafap_classes/init.php');
  include ('../pafap_classes/sign_up_class.php');
  include ('../pafap_classes/templates_pafap_class.php');
  $cat = new pafap_SignUp();
  $tmpl = new pafap_templates;
  $sql = "SELECT subid, subcname FROM vlereso_subcategory WHERE cid = '{$catid}'";
  $subcat = $cat->binder($sql, "subid", "subcname");
  $tmpl->showbinder($subcat);
}

?>