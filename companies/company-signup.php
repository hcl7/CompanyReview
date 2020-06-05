<?php
//error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/sign_up_class.php');
include ('../pafap_classes/templates_pafap_class.php');
include ('../mailer/sender-class.php');
$tmpl = new pafap_templates;
if($_POST['fname'] != '' && $_POST['website'] != '' && $_POST['emailAddress'] != '' && $_POST['telephone'] != '' && $_POST['companyName'] != '' && $_POST['locale'] != '' )
{
  $tmpl = new pafap_templates;
  $sender = new sender();
  $signup = new pafap_SignUp();
  $fname = $_POST['fname'];
  $web = $_POST['website'];
  $emailaddr = $_POST['emailAddress'];
  $phone = $_POST['telephone'];
  $compname = $_POST['companyName'];
  $location = $_POST['locale'];
  if($signup->compfirstprocess($emailaddr, $fname, $web, $phone, $compname, $location))
  {
    $tmpl->show_message($signup->show_errors(), 'pafap_success');
    if($sender->companysend($emailaddr, $fname)){ $tmpl->_show("pafap_success", "Go to Your Email to Activate your Company Account!");}
    else $tmpl->_show("pafap_warning", "Email Not Sent!");
  }
  else
  {
    $tmpl->show_message($signup->show_errors(), 'pafap_error');
  }
}
else $tmpl->_show("pafap_warning", "Fill the form!");

?>