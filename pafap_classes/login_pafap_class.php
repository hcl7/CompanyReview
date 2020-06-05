<?php

include ('mysql_pafap_class.php');

class pafap_login extends pafap_mysql
{
  private $_id;
  private $_email;
  private $_pass;
  private $_fname;
  private $_lname;
  private $_passmd5;
  private $_image;
  private $_errors;
  private $_access;
  private $_login;
  private $_token;

  public function __construct()
  {
    $this->pafap_mysql();
    $this->_errors = array();
    $this->_login = isset($_POST['login'])? 1 : 0;
    $this->_access = 0;
    //$this->_token = $_POST['token'];

    $this->_id = 0;
    $this->_email = ($this->_login)? $this->filter($_POST['login-email']) : $_SESSION['email'];
    $this->_pass = ($this->_login)? $this->filter($_POST['login-password']) : '';
    $this->_passmd5 = ($this->_login)? md5($this->_pass) : $_SESSION['password'];

  }

  public function isLoggedIn()
  {
    ($this->_login)? $this->CheckPost() : $this->CheckSession();

    return $this->_access;
  }

  public function filter($var)
  {
    return preg_replace('/[^a-zA-z0-9@_.]/','', $var);
  }

  public function CheckPost()
  {
    try
    {
      //if (!$this->isTokenValid())
        //throw new Exception('Invalid Form Submission!');

      if (!$this->isDataValid())
        throw new Exception('Invalid Form Data!');

      if (!$this->CheckDatabase())
        throw new Exception('Invalid Email/Password!');

      $this->_access = 1;
      $this->registerSession();
      $this->_errors[] = 'Sucess!';
    }
    catch(Exception $e)
    {
      $this->_errors[] = $e->getMessage();
      $_SESSION['loginerror'] = $this->_errors;
    }
  }

  public function CheckSession()
  {
    if($this->sessionExist() && $this->CheckDatabase())
        $this->_access = 1;
  }

  public function CheckDatabase()
  {
    $sql = "SELECT uid, image, email, fname, lname FROM vlereso_users WHERE email = '{$this->_email}' AND pass = '{$this->_passmd5}' AND status >= 1";
    $this->ExecuteSQL($sql);

    if ($this->iRecords > 0)
    {
      $data = $this->ArrayResults($sql);
      foreach ($data as $row)
      {
        $this->_id = $row["uid"];
        $this->_image = $row['image'];
        $this->_email = $row["email"];
        $this->_fname = $row["fname"];
        $this->_lname = $row["lname"];
      }
      return true;
    }
    else
    {
      return false;
    }
  }

  public function isDataValid()
  {
    return ($this->_checkEmail($this->_email))? 1 : 0;
  }

  public function isTokenValid()
  {
    return (!isset($_SESSION['token']) || $this->_token != $_SESSION['token'])? 0 : 1;
  }

  public function registerSession()
  {
    $_SESSION['uid'] = $this->_id;
    $_SESSION['email'] = $this->_email;
    $_SESSION['password'] = $this->_passmd5;
    $_SESSION['image'] = $this->_image;
    $_SESSION['fname'] = $this->_fname;
    $_SESSION['lname'] = $this->_lname;
  }

  public function sessionExist()
  {
    return (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['uid']) && isset($_SESSION['image']))? 1 : 0;
  }

  public function showErrors()
  {
    return $this->_errors;
  }

  public function _checkEmail($email)
  {
  	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	if (preg_match($regex, $email))
    {
      $this->SecureData($email);
      return true;
    }
    else
    { return false; }
  }

}

?>