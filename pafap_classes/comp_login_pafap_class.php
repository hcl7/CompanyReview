<?php

include ('mysql_pafap_class.php');

class pafap_clogin extends pafap_mysql
{
  private $_id;
  private $_email;
  private $_pass;
  private $_passmd5;
  private $_image;
  private $_errors;
  private $_access;
  private $_clogin;
  private $_token;
  private $_name;

  public function __construct()
  {
    $this->pafap_mysql();
    $this->_errors = array();
    $this->_clogin = isset($_POST['clogin'])? 1 : 0;
    $this->_access = 0;
    //$this->_token = $_POST['ctoken'];

    $this->_id = 0;
    $this->_email = ($this->_clogin)? $this->filter($_POST['clogin-email']) : $_SESSION['cemail'];
    $this->_pass = ($this->_clogin)? $this->filter($_POST['clogin-password']) : '';
    $this->_passmd5 = ($this->_clogin)? md5($this->_pass) : $_SESSION['cpassword'];

  }

  public function isLoggedIn()
  {
    ($this->_clogin)? $this->CheckPost() : $this->CheckSession();

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
      $_SESSION['cloginerror'] = $this->_errors;
    }
  }

  public function CheckSession()
  {
    if($this->sessionExist() && $this->CheckDatabase())
        $this->_access = 1;
  }

  public function CheckDatabase()
  {
    $sql = "SELECT companyid, image, email, name FROM vlereso_companies WHERE email = '{$this->_email}' AND pass = '{$this->_passmd5}' AND status = 1";
    $this->ExecuteSQL($sql);

    if ($this->iRecords > 0)
    {
      $data = $this->ArrayResults($sql);
      foreach ($data as $row)
      {
        $this->_id = $row["companyid"];
        $this->_image = $row['image'];
        $this->_email = $row["email"];
        $this->_name = $row["name"];
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
    return (!isset($_SESSION['ctoken']) || $this->_token != $_SESSION['ctoken'])? 0 : 1;
  }

  public function registerSession()
  {
    $_SESSION['companyid'] = $this->_id;
    $_SESSION['cemail'] = $this->_email;
    $_SESSION['cpassword'] = $this->_passmd5;
    $_SESSION['cimage'] = $this->_image;
    $_SESSION['cfname'] = $this->_name;
  }

  public function sessionExist()
  {
    return (isset($_SESSION['cemail']) && isset($_SESSION['cpassword']) && isset($_SESSION['companyid']) && isset($_SESSION['cimage']))? 1 : 0;
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

  public function sd($data)
  {
    return mysqli_real_escape_string($this->dbConnLink, $data);
  }

}

?>