<?php
if(!isset($_SESSION))
{
  session_start();
}
include ('../pafap_classes/init.php');
include ('../pafap_classes/sign_up_class.php');
$reg = new pafap_SignUp();

// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( 'nr','key' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://vlereso.com/1353/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
  $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
  $femail = $graphObject->getProperty('email');

  $reg->fbregister($fbid, $fbfullname);

  /*$_SESSION['uid'] = $fbid;
  $_SESSION['fname'] = $fbfullname;
  $_SESSION['email'] =  $femail;
  $_SESSION['image'] = '../images/DEFAULT.png';*/

  echo ("<script>location.href='http://vlereso.com';</script>");
} else {
  $loginUrl = $helper->getLoginUrl();
  header("Location: ".$loginUrl);
}
?>
