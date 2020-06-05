<?php
//define('DISPLAY_ERRORS', true);
//define('DISPLAY_EXCEPTIONS', true);

/*set_time_limit(0);
ini_set('memory_limit',-1);
ini_set('max_execution_time',0);
ini_set('ignore_user_abort','On');
//ini_set('display_errors', (DISPLAY_ERRORS)?(1):(0));
//ini_set('display_startup_errors', (DISPLAY_ERRORS)?(1):(0));
//error_reporting((DISPLAY_ERRORS)?(1):(0));
//ignore_user_abort (true);
//date_default_timezone_set('Europe/Tirana');
*/
/**
*
* SMTP4PHP :  PHP powerful tool for sending e-mails fast and easily.
*
* SMTP4PHP is a collection of PHP classes, dedicated for composing and sending
* multipart/mixed email messages quickly and easily, with or without embedded
* images and/or attachments.
*
* Copyright (c) 2011 - 2012, Raul IONESCU <ionescu.raul@gmail.com>,
* Bucharest, ROMANIA
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @package      SMTP4PHP
* @author       Raul IONESCU <ionescu.raul@gmail.com>
* @copyright    Copyright (c) 2011 - 2012, Raul IONESCU.
* @license      http://www.opensource.org/licenses/mit-license.php The MIT License
* @version      2011, 14th release
* @link         https://plus.google.com/u/0/109110210502120742267
* @access       public
*
* PHP versions 5.3 or greater
*/

/*

GMail - TLS encryption example
==============================================
define('SMTP_SERVER','tls://smtp.gmail.com');
define('SMTP_SERVER_PORT',587);

GMail - SSL encryption example
==============================================
define('SMTP_SERVER','ssl://smtp.gmail.com');
define('SMTP_SERVER_PORT',465);

Yahoo Mail - SSL encryption example
==============================================
define('SMTP_SERVER','ssl://smtp.mail.yahoo.com');
define('SMTP_SERVER_PORT',465);

Windows Live.com - TLS encryption example
==============================================
define('SMTP_SERVER','tls://smtp.live.com');
define('SMTP_SERVER_PORT',587);

*/

define('SMTP_SERVER','mail.fjalaejetes.com');
define('SMTP_SERVER_PORT',587);

define('SMTP_USER','elvinmucah@fjalaejetes.com');
define('SMTP_PASSWORD','El7viNhcl');

define('FROM_NAME','Vlereso Team');
define('FROM_EMAIL',SMTP_USER);

/*///////////////////////////////////////////////////////////////////////////////////////*/
require_once('SMTP4PHP.php');
use SMTP4PHP\User;
/*
//NOTE: Only if backward compatibility is really needed.
use SMTP4PHP\eMailUser;
*/
use SMTP4PHP\eMail;
use SMTP4PHP\SMTP;

class sender {
  /* user send email */
  public function usersend($email, $name){
    $e = new eMail();
    $e->from = new User(FROM_NAME, FROM_EMAIL);
    $e->to = new User(FROM_NAME, $email);
    $e->subject = 'Activation Account!';
    /*
    EXAMPLE: add inline image example
    $e->htmlMessage = 'This is a HTML message!<br><img src="'.$e->addImage('./image.jpg').'" border="0">';
    */
    $e->htmlMessage = "
    <html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel='stylesheet' type='text/css' href='http://185.120.38.103:8080/css/layout.css'>
        <!--[if gte IE 9]>
          <style type='text/css'>
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->
        <title>

        {$name}, Activate your Vlereso account

        </title>
    </head>
    <body>

        <div class='wrapper'>
            <div class='maintable'>
                <div class='content-left'>
                    <div class='icon'>

    <img src='logo.jpg' width='55' height='55' border='0' style='display:block;'>

                    </div>
                </div>
                <div class='content'>
                    <img src='logo.png' width='265' height='30' alt='Vlereso' title='Vlereso' />
                    <h1>

          <p>
          Hi $name,</p>

    </h1>
    <p>
	<span style='color: rgb(0, 0, 0); font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;'>Get the most out of Vlereso by activating your account now. Just press the button to start sharing your reviews. </span></p>
    <p>
	&nbsp;</p>
    <p>
    <table>
    <tr>
        <td align='center' width='260' bgcolor='#0099ff' height='34' style='background: #0099ff; border: 1px solid #003366; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; color: #fff; font-weight: bold; text-decoration: none; font-family: Helvetica, Arial, sans-serif;'><a href='http://185.120.38.103:8080/users/activate.php?email=".base64_encode($email)."&name=".base64_encode($name)."' style='color: #ffffff; text-decoration: none; width:100%; display:inline-block; line-height:34px'>Activate Your Account</a>
    </tr>
    </table>
    <br />
	&nbsp;</p>
    <p>
	Enjoy,<br />
	The Vlereso Team</p>
                    <div class='horizontal-line'></div>
                </div>
            </div>
        </div>

    </body>
    </html>
    ";
    /*
    EXAMPLE: add attachment example
    $e->addAttachment('Attachment.zip');
    */
    $smtp = new SMTP(SMTP_SERVER, SMTP_SERVER_PORT, SMTP_USER, SMTP_PASSWORD);
    /* NOTE: ALL emails are sent through the same connection, speeding up transmission. */
    try { $smtp->send($e); /* OR $smtp->send($e,$e2);*/ }
    catch(Exception $e) { }
    //var_dump($smtp->SMTPlog);
    return true;
  }

  /* user activate send email */
  public function activateusersend($email, $name){
    $e = new eMail();
    $e->from = new User(FROM_NAME, FROM_EMAIL);
    $e->to = new User(FROM_NAME, $email);
    $e->subject = 'Activation Account!';
    /*
    EXAMPLE: add inline image example
    $e->htmlMessage = 'This is a HTML message!<br><img src="'.$e->addImage('./image.jpg').'" border="0">';
    */
    //$e->htmlMessage = "";
    $e->txtMessage = 'Your Account is Activated! <br /> Thank you. <br /> www.vlereso.com';
    /*
    EXAMPLE: add attachment example
    $e->addAttachment('Attachment.zip');
    */
    $smtp = new SMTP(SMTP_SERVER, SMTP_SERVER_PORT, SMTP_USER, SMTP_PASSWORD);
    /* NOTE: ALL emails are sent through the same connection, speeding up transmission. */
    try { $smtp->send($e); /* OR $smtp->send($e,$e2);*/ }
    catch(Exception $e) { }
    //var_dump($smtp->SMTPlog);
    return true;
  }

  /* company send email */
  public function companysend($email, $name){
    $e = new eMail();
    $e->from = new User(FROM_NAME, FROM_EMAIL);
    $e->to = new User(FROM_NAME, $email);
    $e->subject = 'Activation Account!';
    /*
    EXAMPLE: add inline image example
    $e->htmlMessage = 'This is a HTML message!<br><img src="'.$e->addImage('./image.jpg').'" border="0">';
    */
    $e->htmlMessage = "
    <html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel='stylesheet' type='text/css' href='http://185.120.38.103:8080/css/layout.css'>
        <!--[if gte IE 9]>
          <style type='text/css'>
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->
        <title>

        {$name}, Activate your Vlereso account

        </title>
    </head>
    <body>

        <div class='wrapper'>
            <div class='maintable'>
                <div class='content-left'>
                    <div class='icon'>

    <img src='logo.jpg' width='55' height='55' border='0' style='display:block;'>

                    </div>
                </div>
                <div class='content'>
                    <img src='logo.png' width='265' height='30' alt='Vlereso' title='Vlereso' />
                    <h1>

          <p>
          Hi $name,</p>

    </h1>
    <p>
	<span style='color: rgb(0, 0, 0); font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;'>Get the most out of Vlereso by activating your account now. Just press the button to start sharing your reviews. </span></p>
    <p>
	&nbsp;</p>
    <p>
    <table>
    <tr>
        <td align='center' width='260' bgcolor='#0099ff' height='34' style='background: #0099ff; border: 1px solid #003366; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; color: #fff; font-weight: bold; text-decoration: none; font-family: Helvetica, Arial, sans-serif;'><a href='http://185.120.38.103:8080/companies/activate.php?email=".base64_encode($email)."&name=".base64_encode($name)."' style='color: #ffffff; text-decoration: none; width:100%; display:inline-block; line-height:34px'>Activate Your Company Account</a>
    </tr>
    </table>
    <br />
	&nbsp;</p>
    <p>
	Enjoy,<br />
	The Vlereso Team</p>
                    <div class='horizontal-line'></div>
                </div>
            </div>
        </div>

    </body>
    </html>
    ";
    /*
    EXAMPLE: add attachment example
    $e->addAttachment('Attachment.zip');
    */
    $smtp = new SMTP(SMTP_SERVER, SMTP_SERVER_PORT, SMTP_USER, SMTP_PASSWORD);
    /* NOTE: ALL emails are sent through the same connection, speeding up transmission. */
    try { $smtp->send($e); /* OR $smtp->send($e,$e2);*/ }
    catch(Exception $e) { }
    //var_dump($smtp->SMTPlog);
    return true;
  }


  /* company activate send email */
  public function activatecompanysend($email, $name){
    $e = new eMail();
    $e->from = new User(FROM_NAME, FROM_EMAIL);
    $e->to = new User(FROM_NAME, $email);
    $e->subject = 'Activation Account!';
    /*
    EXAMPLE: add inline image example
    $e->htmlMessage = 'This is a HTML message!<br><img src="'.$e->addImage('./image.jpg').'" border="0">';
    */
    //$e->htmlMessage = "";
    $e->txtMessage = 'Your Company Account is Activated! <br /> Thank you. <br /> www.vlereso.com';
    /*
    EXAMPLE: add attachment example
    $e->addAttachment('Attachment.zip');
    */
    $smtp = new SMTP(SMTP_SERVER, SMTP_SERVER_PORT, SMTP_USER, SMTP_PASSWORD);
    /* NOTE: ALL emails are sent through the same connection, speeding up transmission. */
    try { $smtp->send($e); /* OR $smtp->send($e,$e2);*/ }
    catch(Exception $e) { }
    //var_dump($smtp->SMTPlog);
    return true;
  }

}
?>
