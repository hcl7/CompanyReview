<?php

include ('mysql_pafap_class.php');

class pafap_SignUp extends pafap_mysql
{
  private $fname;
  private $lname;
  private $email;
  private $password;
  private $repass;
  private $passmd5;
  private $errors;
  private $token;
  private $tmp;

  public function __construct()
  {
    $this->pafap_mysql();
  }

  public function firstprocess($lemail, $name)
  {
    $localname = explode(" ", $name);
    if (empty($localname[1])) $localname[1] = $localname[0];
    if ($this->firstValidate_form($lemail, $name))
    {
      $this->iAffected = 0;
      $users = "INSERT INTO vlereso_users (fname, lname, email, status, date_created) VALUES ('{$localname[0]}', '{$localname[1]}', '{$lemail}', 0, now())";
      $this->register($users);
      if ($this->iAffected > 0)
        $this->errors[] = 'Success!';
      return true;
    }
    return false;
  }

  public function compfirstprocess($lemail, $name, $web, $phone, $company, $location)
  {
    if ($this->compfirstValidate_form($lemail, $name, $web, $phone, $company, $location))
    {
      $this->iAffected = 0;
      $comp = "INSERT INTO vlereso_companies (name, header, email, phone, website, location, status, date_created) VALUES ('{$name}', '{$company}', '{$lemail}', '{$phone}', '{$web}', '{$location}', 0, now())";
      $this->register($comp);
      if ($this->iAffected > 0)
        $this->errors[] = 'Success!';
      return true;
    }
    return false;
  }

  public function secondprocess($pass, $repass, $email)
  {
    if ($this->secondValidate_form($pass, $repass, $email))
    {
      $this->iAffected = 0;
      $users = "UPDATE vlereso_users SET pass = '{$this->passmd5}', image = '../users/DEFAULT.PNG', status = 1 WHERE email = '{$email}'";
      $this->register($users);
      if ($this->iAffected > 0)
        $this->errors[] = 'Success!';
      return true;
    }
    return false;
  }
  /* company second process signup*/
  public function compsecondprocess($pass, $repass, $email, $cid, $subid)
  {
    if ($this->compsecondValidate_form($pass, $repass, $email, $cid, $subid))
    {
      $this->iAffected = 0;
      $cusers = "UPDATE vlereso_companies SET pass = '{$this->passmd5}', cid = '{$cid}', subid = '{$subid}',  status = 1, image = '../companies/DEFAULT.png' WHERE email = '{$email}'";
      $this->register($cusers);
      if ($this->iAffected > 0)
        $this->errors[] = 'Success!';
      return true;
    }
    else return false;
  }

  public function filter($var)
  {
    return preg_replace('/[^a-zA-Z0-9@_.]/','',$var);
  }

  /* users email exists check*/
  public function email_exists($table, $field, $email)
  {
    $query = "SELECT $field FROM $table WHERE $field = '{$email}'";
    $this->ExecuteSQL($query);
    return($this->iRecords > 0)? 1 : 0;
  }

  /* company email exists check */
  public function compemail_exists($table, $field, $email, $company)
  {
    $query = "SELECT $field FROM $table WHERE $field = '{$email}' AND header = '{$company}'";
    $this->ExecuteSQL($query);
    return($this->iRecords > 0)? 1 : 0;
  }

  /* users and company email activation check status*/
  public function active_email_exists($table, $field, $email)
  {
    $query = "SELECT $field FROM $table WHERE $field = '{$email}' AND status = 0";
    $this->ExecuteSQL($query);
    return($this->iRecords > 0)? 1 : 0;
  }

  public function register($sql)
  {
    $this->ExecuteSQL($sql);
  }

  public function show_errors()
  {
    return $this->errors;
  }

  /* user first validation form */
  public function firstValidate_form($lemail, $name)
  {
    $localname = explode(" ", $name);
    if (empty($localname[1])) $localname[1] = $localname[0];
    if(empty($localname[0]) || empty($localname[1]) || empty($lemail))
        $this->errors[] = 'Please, Fill The Form!';
    else
    {
      if(!$this->checkEmail($lemail))
          $this->errors[] = 'Invalid Email!';
      else
      {
        if($this->email_exists("vlereso_users", "email", $lemail))
            $this->errors[] = 'Sory, Email Already In Use!';
      }
    }
    return count($this->errors)? 0 : 1;
  }
  /* company first validation form */
  public function compfirstValidate_form($lemail, $name, $web, $phone, $company, $location)
  {
    if(empty($name) || empty($lemail) || empty($web) || empty ($phone) || empty($company) || empty($location))
        $this->errors[] = 'Please, Fill The Form!';
    else
    {
      /* company email check*/
      if(!$this->checkEmail($lemail))
          $this->errors[] = 'Invalid Email!';
      else
      {
        if($this->compemail_exists("vlereso_companies", "email", $lemail, $company))
            $this->errors[] = 'Sory, Email Already In Use or Your Company Name!';
      }
    }
    return count($this->errors)? 0 : 1;
  }

  /* user second validation form */
  public function secondValidate_form($pass, $repass, $email)
  {
    if (strcmp($pass, $repass) == 0){
      if(!empty($pass)){
        $this->password = $pass;
        $this->repass = $repass;
        $this->passmd5 = md5($this->password);
      }
      else $this->errors[] = "Please Fill the Form";
    }
    else $this->errors[] = 'Password is not equal!';

    if($this->active_email_exists("vlereso_users", "email", $email))
            $this->errors[] = 'Account Already Activated!';
    return count($this->errors)? 1 : 0;
  }

  /* company second validation form */
  public function compsecondValidate_form($pass, $repass, $email, $cid, $subid)
  {
    if (strcmp($pass, $repass) == 0){
      if(!empty($pass)){
        $this->password = $pass;
        $this->repass = $repass;
        $this->passmd5 = md5($this->password);
      }
      else $this->errors[] = "Please Fill the Form";
    }
    else $this->errors[] = 'Password is not equal!';

    if($this->active_email_exists("vlereso_companies", "email", $email))
            $this->errors[] = 'Company Account Activated!';
    else $this->errors[] = 'Company Account Already Activated!';
    return count($this->errors)? 1 : 0;
  }

  public function checkEmail($email)
  {
    $email = strtolower($email);
  	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (preg_match($regex, $email))
      return true;
    else
      return false;
  }

  public function compareEmail($mail, $remail)
  {
    return (strcmp($mail, $remail))? 0 : 1;
  }

  public function getValueFromTable($sql)
  {
    $this->ExecuteSQL($sql);
    list($this->_tmp) = $this->iAssoc;
    return $this->_tmp;
  }

  public function sd($data)
  {
    return mysqli_real_escape_string($this->dbConnLink, $data);
  }

  public function binder($sql, $fieldID, $fieldName)
  {
    $arr = array();
    $result = mysqli_query($this->dbConnLink, $sql);
    while($row=mysqli_fetch_assoc($result))
    {
      ($fieldID == "")? $arr[] = $row[$fieldName] : $arr[$row[$fieldID]] = $row[$fieldName];
    }
    return $arr;
  }

  //facebook login and check users
  public function checkFBId($fbid){
    $sql = "SELECT uid, image, email, fname, lname FROM vlereso_users WHERE email = '{$fbid}' AND status >= 1";
    $this->ExecuteSQL($sql);

    if ($this->iRecords > 0)
    {
      $data = $this->ArrayResults($sql);
      foreach ($data as $row)
      {
        $_SESSION['uid'] = $row["uid"];
        $_SESSION['image'] = $row['image'];
        $_SESSION['email'] = $row["email"];
        $_SESSION['fname'] = $row["fname"];
        $_SESSION['lname'] = $row["lname"];
      }
      return true;
    }
    else
    {
      return false;
    }
  }

  public function fbregister($fbid, $name)
  {
    $localname = explode(" ", $name);
    if (empty($localname[1])) $localname[1] = $localname[0];
    if (!$this->checkFBId($fbid))
    {
      $this->iAffected = 0;
      $users = "INSERT INTO vlereso_users (fname, lname, email, status, date_created) VALUES ('{$localname[0]}', '{$localname[1]}', '{$fbid}', 1, now())";
      $this->register($users);
    }
    $this->checkFBId($fbid);
  }

}
?>