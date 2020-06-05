<?php
error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/sign_up_class.php');
include ('../pafap_classes/templates_pafap_class.php');
include ('../mailer/sender-class.php');
$tmpl = new pafap_templates;
if(isset($_POST['email-active']) && isset($_POST['name-active']))
{
  if(isset($_POST['passwordlogin']) && isset($_POST['reenterpasswordlogin']))
  {
    $sender = new sender();
    $signup = new pafap_SignUp();
    $email = base64_decode($_POST['email-active']);
    $user = base64_decode($_POST['name-active']);
    $pass = $_POST['passwordlogin'];
    $repass = $_POST['reenterpasswordlogin'];
    $tmpl->_show("pafap_success", base64_decode($_POST['email-active']));
    if($signup->secondprocess($pass, $repass, $email))
    {
      $tmpl->show_message($signup->show_errors(), 'pafap_success');
      if($sender->activateusersend($email, $user)){
        $tmpl->_show("pafap_success", "Your Account is Activated! go to <a href='/users/login.php?status=true'>Login</a>");
      }
    }
    else
    {
      $tmpl->show_message($signup->show_errors(), 'pafap_error');
    }
  }
  else $tmpl->_show("pafap_error", "POST Error!...");
}
else $tmpl->_show("pafap_error", "GET Error!...");

?>