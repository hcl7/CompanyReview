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

if($_POST['signupemail'] != '' && $_POST['signupusername'] != '')
{
  $tmpl = new pafap_templates;
  $sender = new sender();
  $signup = new pafap_SignUp();
  $email = $_POST['signupemail'];
  $user = $_POST['signupusername'];
  if (isset($_POST['terms'])){
    if($signup->firstprocess($email, $user))
    {
      $tmpl->show_message($signup->show_errors(), 'pafap_success');
      if($sender->usersend($email, $user)){ $tmpl->_show("pafap_success", "Go To Your Email to Activate your Account!");}
      else $tmpl->_show("pafap_warning", "Email Not Sent!");
    }
    else
    {
      $tmpl->show_message($signup->show_errors(), 'pafap_error');
    }
  }
  else $tmpl->_show("pafap_warning", "You must accept the Terms & Conditions and Privacy Policy!");
}
?>

