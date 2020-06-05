<?php
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
$bind = new pafap_bind();
$tmpl = new pafap_templates;
$guid = $_POST['juid'];
$limit = 0;
if (isset($_POST['moreresultsusersbycompanyid'])){
  $limit += $_POST['moreresultsusersbycompanyid'];
  $datausersql = "select vlereso_companies.header, vlereso_companies.companyid, vlereso_review.date_created, rnotes, stars from vlereso_review
  	  inner join vlereso_companies on vlereso_review.rcompanyid = vlereso_companies.companyid and vlereso_review.ruid = '{$bind->sd($guid)}' ORDER BY vlereso_review.date_created DESC";
  $datausersprof = $bind->ArrayResults($datausersql);
  $tmpl->companyBinderByUid($datausersprof, $limit);
}

?>