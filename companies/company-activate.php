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
  if(isset($_POST['cpasswordlogin']) && isset($_POST['creenterpasswordlogin']) && isset($_POST['category']) && isset($_POST['subcat']))
    {
      $sender = new sender();
      $signup = new pafap_SignUp();
      $email = $_POST['email-active'];
      $user = $_POST['name-active'];
      $cat = $_POST['category'];
      $subcat = $_POST['subcat'];
      $pass = $_POST['cpasswordlogin'];
      $repass = $_POST['creenterpasswordlogin'];
      if($signup->compsecondprocess($pass, $repass, $email, $cat, $subcat))
      {
        $tmpl->show_message($signup->show_errors(), 'pafap_success');
        if($sender->activatecompanysend($email, $user)){
          $tmpl->_show("pafap_success", "Your Company Account is Activated! go to <a href='/companies/login.php?status=true'>Login</a>");
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