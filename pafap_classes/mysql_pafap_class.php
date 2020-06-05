<?php
error_reporting(0);
class pafap_mysql
{
	var $strLastError;				
	var $strLastQuery;				
	var $aResult;					
	var $iRecords;					
	var $iAffected;
    var $iAssoc;
	var $aResults;
	var $aArrayedResult;
	var $aArrayedResults;

	var $sHostname = MYSQL_HOST;	
	var $sUsername = MYSQL_USER;	
	var $sPassword = MYSQL_PASS;	
	var $sDatabase = MYSQL_NAME;	

	var $dbConnLink;
	//constructor;
	function pafap_mysql(){
	  $this->Connect();
	}
	// Connects class to database
	function Connect($persist = false)
    {
      if($this->dbConnLink)
      {
        mysqli_close($this->dbConnLink);
	  }
	  if($persist)
      {
        $this->dbConnLink = mysqli_pconnect($this->sHostname, $this->sUsername, $this->sPassword);
	  }
      else
      {
        $this->dbConnLink = mysqli_connect($this->sHostname, $this->sUsername, $this->sPassword);
	  }
	  if (!$this->dbConnLink)
      {
        $this->strLastError = 'Could not connect to server: ' . mysqli_error($this->dbConnLink);
		return false;
	  }
	  if(!$this->UseDB())
      {
        $this->strLastError = 'Could not connect to database: ' . mysqli_error($this->dbConnLink);
		return false;
	  }
	  return true;
	}
	// Select database to use
	function UseDB()
    {
      if (!mysqli_select_db($this->dbConnLink, $this->sDatabase))
      {
	  	$this->strLastError ='Cannot select database: ' . mysqli_error($this->dbConnLink);
	  	return false;
	  }
      else
      {
	  	return true;
	  }
	}
	// Executes MySQL query (select);
	function ExecuteSQL($strSQLQuery)
	{
	  try{
	    $this->strLastQuery = $strSQLQuery;
	    $aResult = mysqli_query($this->dbConnLink, $strSQLQuery);
	    $this->aResult = $aResult;
	    if($aResult)
	    {
	      $this->iRecords = @mysqli_num_rows($aResult);
		  $this->iAffected = @mysqli_affected_rows($this->dbConnLink);
          $this->iAssoc = @array_values(mysqli_fetch_assoc($aResult));
          $this->aResults = @mysqli_fetch_array($aResult, MYSQL_BOTH);
		  return true;
	    }
	    else
	    {
	      $this->strLastError = mysqli_error($this->dbConnLink);
		  return false;
	    }
	  }
	  catch(Exception $e){
	  	$this->strLastError = $e->getMessage();
	  	return false;
	  }
	}

	// 'Arrays' multiple result;
	function ArrayResults($sql, $field=''){
	  $this->aArrayedResults = array();
	  if ($field == NULL){
        $result = mysqli_query($this->dbConnLink, $sql);
	    while ($aData = mysqli_fetch_array($result)){
	  	  $this->aArrayedResults[] = $aData;
	    }
      }
      else
      {
        $result = mysqli_query($this->dbConnLink, $sql);
	    while ($aData = mysqli_fetch_assoc($result)){
	  	  $this->aArrayedResults[] = $aData[$field];
	    }
      }
      return $this->aArrayedResults;
	}

	// Performs a 'mysql_real_escape_string' on the entire array/string
	function SecureData($aData)
	{
	  $aData = mysqli_real_escape_string($this->dbConnLink, $aData);
	  return $aData;
	}

    function dbCloseConn()
    {
      mysqli_close($this->dbConnLink);
    }

}

?>
