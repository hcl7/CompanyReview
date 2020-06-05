<?php
include('../pafap_classes/init.php');
include('../pafap_classes/login_pafap_class.php');
include('../pafap_classes/templates_pafap_class.php');

$sql = "SELECT uid, image FROM vlereso_users where email = 'emuco7@yahoo.com'";
$log = new pafap_login();
$log->ExecuteSQL_Records_Affected($sql);
echo $log->iRecords;
echo "<br />";
$res = $log->ArrayResults($sql);
foreach ($res as $row)
{
  $_SESSION['uid'] = $row["uid"];
  $_SESSION['image'] = $row["image"];
}


?>