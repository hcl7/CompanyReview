<?php
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
$companyid = $_POST['jcmpid'];
$tmpl = new pafap_templates;
$cget = new pafap_bind();
$limit = 0;
if (isset($_POST['moreresultsusersbycompanyid'])){
  $limit += $_POST['moreresultsusersbycompanyid'];
  $sqlusersreview = "SELECT vlereso_users.fname, vlereso_companies.header, ruid, stars, vlereso_review.date_created, rnotes FROM vlereso_users inner join  vlereso_review on vlereso_users.uid = vlereso_review.ruid inner join vlereso_companies on vlereso_companies.companyid = vlereso_review.rcompanyid AND rcompanyid = '{$cget->SecureData($companyid)}' ORDER BY vlereso_review.date_created DESC";
  $datausersreview = $cget->ArrayResults($sqlusersreview);
  $tmpl->usersReviewByCompanyID($datausersreview, $companyid, $limit);
}

?>