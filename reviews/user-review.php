<?php

error_reporting(0);
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/bind_pafap_class.php');
include ('../mailer/sender-class.php');

if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  //$sender = new sender();
  $ip = $_SERVER["REMOTE_ADDR"];
  if($_POST['category'] != '' && $_POST['subcategory'] != '' && $_POST['cemail'] != '' && $_POST['txtReview'] != '' && $_POST['stars'] != '' && $_POST['cmpid'] != ''){
    $bind = new pafap_bind();
    $tmpl = new pafap_templates;
    $cid = $_POST['category'];
    $subid = $_POST['subcategory'];
    $cemail = $_POST['cemail'];
    $companyid = $_POST['cmpid'];
    $star = $_POST['stars'];
    $note = $_POST['txtReview'];
    if($_POST['reference'] != ''){
      $reference = $_POST['reference-review'];
      if($bind->checkReference($reference)){
        if($bind->checkReview($uid, $companyid)){
          $bind->updateReview($uid, $companyid, $star, $reference, $note, $ip);
          /*if($sender->usersend($email, $user)){ $tmpl->_show("pafap_success", "An Email is sent to Activate your Account!");}
          else $tmpl->_show("pafap_warning", "Email Not Sent!");*/
        }
        else {
          $bind->postReview($uid, $companyid, $cid, $subid, $star, $reference, $note, $ip);
          /*if($sender->usersend($email, $user)){ $tmpl->_show("pafap_success", "An Email is sent to Activate your Account!");}
          else $tmpl->_show("pafap_warning", "Email Not Sent!");*/
        }
      }
      else $tmpl->_show("pafap_warning", "Reference is Invalid!");
    }
    else {
      if($bind->checkReview($uid, $companyid)){
        $bind->updateReview($uid, $companyid, $star, $reference = 0, $note, $ip);
        /*if($sender->usersend($email, $user)){ $tmpl->_show("pafap_success", "An Email is sent to Activate your Account!");}
        else $tmpl->_show("pafap_warning", "Email Not Sent!");*/
      }
      else {
        $bind->postReview($uid, $companyid, $cid, $subid, $star, $reference = 0, $note, $ip);
        /*if($sender->usersend($email, $user)){ $tmpl->_show("pafap_success", "An Email is sent to Activate your Account!");}
        else $tmpl->_show("pafap_warning", "Email Not Sent!");*/
      }
    }
    $bind->dbCloseConn();
  }
}
?>