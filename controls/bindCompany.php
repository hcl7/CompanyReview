<?php
session_start();
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
$cid = $_POST["jcid"];
$bind = new pafap_bind();
$tmpl = new pafap_templates;
$limit = 0;
if (isset($_POST["moreresultscomp"]))
{
  $limit += $_POST["moreresultscomp"];
  $sqlcompbyid = "SELECT distinct vlereso_companies.header, rcompanyid FROM vlereso_review, vlereso_companies WHERE vlereso_review.rcompanyid = vlereso_companies.companyid and rcid = '{$bind->sd($cid)}'";
  $datacompany = $bind->ArrayResults($sqlcompbyid);
  $compreview = "select rcompanyid, stars from vlereso_review where rcid = '{$bind->sd($cid)}'";
  $datareview = $bind->ArrayResults($compreview);
  $tmpl->CompanyBinderByCid($datacompany, $datareview, $limit);
}
else $tmpl->_show("pafap_error", "Post Error!");

?>
