<?php
//error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/mysql_pafap_class.php');

$search = trim(strip_tags($_GET['term']));
$sql = "select companyid as id, header as value from vlereso_companies where header like '%".$search."%' order by header asc";
$get = new pafap_mysql();
$data = $get->ArrayResults($sql);
foreach($data as $row){
  $row['id'] = (int)$row['id'];
  $row['value'] = htmlentities(stripslashes($row['value']));
  $all_set[] = $row;
}
echo json_encode($all_set);

?>