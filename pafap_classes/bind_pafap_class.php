<?php
include ('mysql_pafap_class.php');
include ('templates_pafap_class.php');
class pafap_bind extends pafap_mysql
{
  private $_wid;
  private $_fuid;
  private $_post;
  private $_postwall;
  private $_tmp;
  private $_default;
  private $_categories;

  public function __construct()
  {
    $this->pafap_mysql();
    $this->_default = "/users/DEFAULT.PNG";
  }

  public function sd($data)
  {
    return mysqli_real_escape_string($this->dbConnLink, $data);
  }

  public function chechValue($aData, $val)
  {
    $i=0;
    foreach($aData as $key=>$value)
    {
      if ($val == $key) $i+=1;
    }
    return ($i > 0)? true : false;
  }

  //vlereso functions

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

  public function checkReview($uid, $compid){
    $sql = "select rid from vlereso_review where ruid = '{$uid}' and rcompanyid = '{$compid}'";
    $this->ExecuteSQL($sql);
    return($this->iRecords > 0)? 1 : 0;
  }

  public function checkReference($ref){
    $sql = "select reference_type from vlereso_companies where reference_type = '{$this->sd($ref)}'";
    $this->ExecuteSQL($sql);
    return($this->iRecords > 0)? 1 : 0;
  }

  public function postReview($uid, $compid, $rcid, $rsubid, $star, $ref, $note, $ip){
    $sql = "insert into vlereso_review (ruid, rcompanyid, rcid, rsubid, stars, reference_type, rnotes, rip, date_created) values ('{$uid}', '{$compid}', '{$rcid}', '{$rsubid}', '{$star}', '{$ref}', '{$note}', '{$ip}', now());";
    $this->ExecuteSQL($sql);
  }

  public function updateReview($uid, $compid, $star, $ref, $note, $ip){
    $sql = "update vlereso_review set stars = '{$star}', reference_type = '{$ref}', rnotes = '{$note}', rip = '{$ip}', date_created = now() where ruid = '{$uid}' and rcompanyid = '{$compid}'";
    $this->ExecuteSQL($sql);
  }

  public function getCatgNameById($cid)
  {
    $widsql = "SELECT cname FROM vlereso_categories WHERE cid = '{$this->sd($cid)}'";
    $result = $this->ArrayResults($widsql);

    foreach ($result as $row)
    {
      $data = $row["cname"];
    }
    return $data;
  }

  public function getCompNameByCatgId($cid)
  {
    $fsql = "SELECT header FROM vlereso_companies WHERE cid = '{$this->sd($cid)}'";
    $result = $this->ArrayResults($fsql);
    foreach ($result as $row)
    {
      $compname = $row["header"];
    }
    return $compname;
  }

  public function averageResult($average){
    if($average == 1 || $average > 0 ) $result = "Poor";
    if($average == 2 || $average > 1 ) $result = "Fair";
    if($average == 3 || $average > 2 ) $result = "Average";
    if($average == 4 || $average > 3 ) $result = "Good";
    if($average == 5 || $average > 4 ) $result = "Excellent";
    return $result;
  }

  public function averageStars($result, $compid, $stars){
    $star = 0;
    foreach ($result as $row){
      if($row["rcompanyid"] == $compid){
        if($row["stars"] == $stars){
          $star += 1;
        }
      }
    }
    return $star;
  }

  public function countReviews($result, $compid){
    $count = 0;
    foreach ($result as $row){
      if($row["rcompanyid"] == $compid){
        $count += 1;
      }
    }
    return $count;
  }

  public function averageByCompId($data, $companyid){
    $star1 = $this->averageStars($data, $this->sd($companyid), 1);
    $star2 = $this->averageStars($data, $this->sd($companyid), 2);
    $star3 = $this->averageStars($data, $this->sd($companyid), 3);
    $star4 = $this->averageStars($data, $this->sd($companyid), 4);
    $star5 = $this->averageStars($data, $this->sd($companyid), 5);
    $nreview = $this->countReviews($data, $this->sd($companyid));
    $average = ($nreview == 0)? $nreview = 1 : ($star1 * 1 + $star2 * 2 + $star3 * 3 + $star4 * 4 + $star5 * 5) / $nreview;
    return $average;
  }

    public function humanTiming ($time)
    {
      $time = time() - $time; // to get the time since that moment
      $time = ($time<1)? 1 : $time;
      $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
      );
      foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
      }
    }

    public function checkUserPass($old, $uid){
      $md5old = md5($old);
      $sql = "select pass from vlereso_users where pass = '{$md5old}' and uid = '{$this->sd($uid)}'";
      $this->ExecuteSQL($sql);
      return($this->iRecords > 0)? 1 : 0;
    }
    //check company old password
    public function checkCompanyPass($old, $cuid){
      $md5old = md5($old);
      $sql = "select pass from vlereso_companies where pass = '{$md5old}' and companyid = '{$this->sd($cuid)}'";
      $this->ExecuteSQL($sql);
      return($this->iRecords > 0)? 1 : 0;
    }

    public function changeUserPassword($new, $uid){
      $md5new = md5($new);
      $sql = "update vlereso_users set pass = '{$md5new}' where uid = '{$this->sd($uid)}'";
      $this->ExecuteSQL($sql);
    }
    //change company account password;
    public function changeCompanyPassword($new, $cuid){
      $md5new = md5($new);
      $sql = "update vlereso_companies set pass = '{$md5new}' where companyid = '{$this->sd($cuid)}'";
      $this->ExecuteSQL($sql);
    }

    public function updateProfileInfo($uid, $text, $name, $city, $country, $birth, $sex){
      $username = explode(" ", $name);
      $sql = "update vlereso_users set profiletext = '{$text}', fname = '{$username[0]}', lname = '{$username[1]}', sex = '{$sex}', birthday = '{$birth}', location = '{$city},{$country}' where uid = '{$uid}'";
      $this->ExecuteSQL($sql);
      return($this->iAffected > 0)? 1 : 0;
    }
    //update company profile info;
    public function updateCompanyProfileInfo($cuid, $text, $header, $addr, $web, $map, $reft, $country){
      $sql = "update vlereso_companies set description = '{$text}', header = '{$header}', address = '{$addr}', website = '{$web}', map = '{$map}', reference_type = '{$reft}', location = '{$country}' where companyid = '{$cuid}'";
      $this->ExecuteSQL($sql);
      return($this->iAffected > 0)? 1 : 0;
    }

    public function deleteUser($uid){
      $usql = "delete from vlereso_users where uid = '{$uid}'";
      $ureview = "delete from vlereso_review where ruid = '{$uid}'";
      $this->ExecuteSQL($usql);
      $this->ExecuteSQL($ureview);
    }

     public function deleteCompany($cuid){
      $csql = "delete from vlereso_companies where companyid = '{$cuid}'";
      $creview = "delete from vlereso_review where rcompanyid = '{$cuid}'";
      $this->ExecuteSQL($csql);
      $this->ExecuteSQL($creview);
    }

}

?>