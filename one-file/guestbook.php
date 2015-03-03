<?php

define('DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', 1);



if ( isset($_REQUEST['img']) ) {
  switch ( $_REQUEST['img'] ) {
    case 'logo_softline.png':
      header('Content-Type: image/png');
      echo base64_decode( "iVBORw0KGgoAAAANSUhEUgAAAKIAAAAhCAYAAABa1nBtAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAe4SURBVHja7JxNaBtHFIBHspw6pk42aaE5FKIUcikUry89FbwquZXGa3pob7Ygx4It6KlQZNNjD7ZPvaRIPpRSKFjuz61Ua2jPXh1KSxrIJi2FQlorl0Bjp+p7yht5tJqdmZVW/pH3wSBZmn07O/PNm/fejJxptVoslVSOW3Kj+mA/Zpw8vJShOFDyEdWaUHx880bLK2j0LWJdqOeHv/v6m+9seFnTNGnz5ttvVWPUL0F9PwXxdEO4SANtaapaBKpOV5lgLvSrB2QnZn1rFMfm9u3b2I8uPZ9/69at2lBBhFmfV1iiLoGZ7yUIIVqbSszLPIkeR7CoqSQD4SKNDVr6AMoSfIZ9XMjFAIsPiE00X6T3XJwBoJUul/T6iBrdLgBtoFG31EcT/BTAI7GECOG6wE2JxmstJ/F1bLJk04ZLSNIi3tOJgNYnYHcIUF/wp9w+7tkgn7KSAjg0QWuIPvI2lGUCEvv7GpR7YYu4JgwEH2wv5N/wz7usmMyxBmiskNWMsqhxB7/nOgLUm/z4hjX2a8ByP/3OMsG/Uddjh9yn9xfpmfIphEOX+8J7hLEKPmIA1rLHR0w0UgNdTYn/5UUszxxahOGqJtqNEufx9AzYcijvMja+9zcbf/CAhcCsQuRbjPAJj0p8ReDT4y6MiCALC8L4l8hHxH5v5kLgHNvDC9B6ITixobP0asfRuX/phXYRwWTZjAV6cfn26J7H+axnSarke5dpWca/56DUoaxmZAlt8pcc8hNtDeUNKDVZfs0wwuWgydIVAen3UD+B6VJ9N4EURycIGv/nITt357fFsZ+jY6GD118tPX5t2g+7JBTI1TX3WoW6KwqXpcci8olCvrtlUpfqL1If5SVWdjtuloIyIC7xkFdY8DYLURMcrB8+xxbpaNIzrcPyXOoCkQBc69Phx4crmQAJ93FpZsSxcKh3A/RXhQ5yz/3159J/Uxecg8nnj2OWo1Ut9AGiSf0CBwbq1zX+a7su6a0YuDSYuyvqVgTS108GoUbP6yuA5HnEdhtyAhyLzCwJHOmfQdkFPUURlhCAFnVUP6C384OgA/2MebgHWqMat6pP33yR7Rds9uT6dXZMUB6rkBU0zZ+6BOuMQl+FIt1+BPW7oKMz+UQB+HoAzQpLZIUlk82vkD4ZhPU+IQwDXyd9HRn74SGb+Oh7duG9T9mFz75g5+/8wrL7T84KhwssfhLfBlBWZEEjlN0BIBSlTEBrJSukbUyWXlPfohIBoZ1Qx9syGLnktv9g5z/4llnvbLCpL7fYxIN7ZyFH1y/ATJLCs5NsG8C4rAWRBtPROPSX8FAAHQy4RBGPEhTyA8WckZ1w59ukVynjn99lk+9/xS7f/KQN5WRj91n0nApKngKhjs9tCDWOf5FSMFWD+mUKeCIlZwAIRsQdp5beFynvZjHFdpwQAJVNHVwMdmhpLxss42XDjuhAOc7usgkeBc+9zJ6+coW1Llvs4MpLrHXuuWfpnrMltjCGJitjkZ8iEgDe0bgGyMkSgRsJota0AhiPwikaeH8twWWjK8lM95mH+5o4zA2onyHojaJRqO9JfNiuazH4aU1NqNI3zRN4TAs3JNaFiHfLwO/PCykiXbRdDUOIgp/B9QualdXVgajrTIssTxkGi1s+fjABt2x82cAKMqfR31Q0sGQAIupfT3pEMfiR+J7+jdaH3gm1bKscQoID0zmrhlaOGQaRG4rvNjUgtt2AqMmbw6UWAPNi5Ip69nkJUFxaNyRQ6pZ+T1z6RTFsm8NSYREuShyLPWtQxxJOYckMltYnjWpTVrA8g4pLkWwnmiX/UCcNzfd+ypheZMfjkjznSVJXFBPLayvTN+STFRNqrCOkVvIJ6HuUYqaV4LQ/QFZYBtG0Y6Y9iVlklFpJJQVRGjWTZSwIhx5mCap+coBLoG+F/EeVXE3Ad0nlaMQb1oTJRQQJATm/1VB6AwGdZmZHsizKBwaaJVpHqj3kzknl0BfXjcX8sI7OSUEUDomin9fESDgcDRNkdU20ZBEoqhRMHnQtg/51STuWDaKxowxm8iMMYsOgjstibCDEAhGjXMHyWBEWx5NYTdwB0c0inD2bTJ8LXMMlXISRIDSJxDaOcLDmoF01wZI3NTnU0yQ1pj99hVt1PecN6XwlP0vgCWPfEJbkQBXFZ9nhbzWiGuDgDkf4gAHtJasgDBBWGiiTwUIY71H6Z88Qwiq5EUlI09Ai7FHBXYvyiEDIT43rJjWyskt70hxCl3UfaHGo8DOnWCq6vsqRxdJ1KFo0lywgb5BumdoU3mNqaJeZbTflY4BTSmogyMKfdT8RV6QFzRjgd1uhnwCbjJUyPZjFyNbQz7IE2nWw+EzYdiOrVTC0OqYPVojakRlweYoj9ihRSFZxPsFx6hgi3e/ReR5xniWXi2onx8OQ8NRQAg8ZEITDCFLi+psj929BaC84KaPRJAi1EzwrWKyZBCKidRUk9Pm1Ae6D+meGBCEjf3Y1zjWG25inEcZBNzfw2hnZaR1l+kY4Z7jKDn8ppzsaFJAFxPNoNZPAQXKfOUXEzvVvs9C5SMUM9AzqqNq3QgctlhRBHD995Me4bzBAO3UTz9cAYdouEcb2ykPHw0QeLEV7OQtVg38N0yWZ9P8jpnIS5H8BBgCsAk2vXQsYhgAAAABJRU5ErkJggg==");
    break;
  
    case 'wait.gif':
      header('Content-Type: image/gif');
      echo gzinflate(base64_decode("lZNrUBNnFIazm+suIdlgrIFSm2wiJAE0EKjxMjZZwiVqnXAJDSiY0MDEolWUim2xzW5IWFDjomjBdrRGZAJSTLFFRqcdkoBS642Ko3VkRrTtQHUc1Nbin9LE9o+WP/1+nu+b87zn/c6bY8jWLLEiNIQ2SKPNzMw8fPhwbGzs7NmzXV1dbW1tJEnW1tZWVlaaTCa9Xq9Wq1EUFQgENAGN9vw97f8cyUzUmqzCgkydMSttoYoORErPGEx2mJ4cuY/IoDFrxTIMaJT94sNAKeOKlDohX776znCgG1aHQn56hx4YQn7NlZX1tWgnRdOU0ebw96MmluuUUcq8bHUR65YdueQMpXbBojh485WlS1XwdpYWZMjqktVgFJ3BBIn1UgBiI0wb6MgA2epPUfq2DDq9QvKiFv5zLe+IZZ6rOAksUaJSOPpoU9Sg5qn6Ynkg3cWuaqFhcVHX7jWvbIyhXJb01sfu5RygWvOgl8JAfJpY72rbpjdqTQB+7Qtqru3kjZJ6hMsBKpXsDZ+ghJypcCNFxaBHKnnZA36YawlzjVbKR5LwHMYq5VJolPV+XAsyEiMNaGvMtHmwU5KgWj4fNEkTY4SH947bHTc3vZ44oi0mvWX2oDWl6s/b8vrA/YXxbidwaM3jOIYDAetkzEwcqFRoico6yWzGl4eh5brDdwXaRjSBDqew76MTyjcyX70H4MMORMlzEUmWdyd46SQvzTIsztjnF5nnchix3pEtA/uY49Aj+6Lcr/ZbFl6FuB337ZT74h/5KEAvLXibjpU6Pibcjib5f7C8MNYQ8bia8rWSV0IdD25h0cnz31t71f4jlzof/FnJzGk8D5tuNx/0DeXSFJpjX+Zcqll5vaxgVNt6xnMuRanf9EPHzXagkNHgmnWbqiPdVZRciHiryQaKxa4SUYHhTgdnsY6eE4fY3MSkX54q9A4MqDi7QYJhC8yBzO0Or8UEXa7IlzQbRZcnCvGAXRyUB7yO4HbJetSYBxYBFdH8YiR6g4LBL0EsO6RcfqL6A36d4rBnVmsj/0mJKZ+GzAp0PDD0u8Bd2apMGD8EjA0UaklhdrOlFUuP8Q1ArqlGQicCcEc5vWSovLp/TwyjO7aXEA/46QQAieadPheiKRZZgQ8LChw8fgKvyAFFbZG9AAX+XaKycJAIDRdN7UFueenBHlVTP966C4ME7PygCuZsPxFChzEPt+enjVt8Xe3HzOXk9bH27CPNgLV3Pt+p0yUoze7zeECuJdXAmVFOsp/Bl0fvRLh5SSsQKH/WOSN5MSKUbwdGiHlJys9T1g7a7vTh496k/Ru0SCyssAD4ai/8ZqLB4luZQzj7psu5xu867z6ye4TRzguPzP0iJogBChXiDd7oNws/y5NygZ0IxFvD2xyF1hiSSgyzjrouwrWwwM6mDk33b896OpWjQ9y99amMvgM8wi4SqIit/h2auX4s0BAjjPsmz8p+tgckh4oGxSwRfFwy8la8vn6j5KgonbPgJog1xD/FKhDYqC9WsViqWYGlYaBM2DIh4hwf8AYNK/bmXQhM8X5/4gFLJ6fEX9tQdxozVsOEco5V5y6BTtJ0eNrBGO+RYccU9grVhY4ni/UNRK48MR4B008Fvs2E16lwjgUwrUaZW/+JCfSStbYw0Wbg7bH0hELdVY8R/zQWfNKKieHT4CbhxAHYo/t+cVqyEHZ2yo2vicyTvV3ENAvav0+o0eYvIKxcaJWgQXnUMecvvQ8P7J5IywKiOMhHCIP9icxZX4nUZLgzF0hoy/4G"));
      break;
  }
  
  exit;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

session_cache_limiter('nocache');
//session_set_cookie_params(14*24*60*60);
session_start();

define('ROOT', '');

////////////////////////////////////////////////////////////////////////////////////////////////////
// Util.php

function xs_MakeRandomStr( $len = 10 ) {
	$str = '';
	while ( strlen($str) < $len )
		$str .= str_shuffle(preg_replace('#[^0-9a-zA-Z]#', '', crypt(uniqid(mt_rand(), true))));
	return substr($str, 0, $len);
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// String.php

class CString
{
  function EscapeForScript( $_s ) {
    return str_replace(array("\r", "\n", '"'), array('\r', '\n', '\"'), $_s);
  }
}

function FSCompatible( $_s ) {
  static $a1 = array('?',':','"','*','\\','|','/','<','>');
  static $a2 = array('7','=',"'",'_','_' ,'_','~','‹','›');
  
  return str_replace( $a1, $a2, $_s );
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// Array.php

class CArray
{
  static function S_Merge( &$t_ra, $_a ) {
    $t_ra = array_merge($t_ra, $_a);
  }
}

class CTable
{
	static function S_GetColumn( $_a, $_sCol )
	{
		$a = array();
		foreach ( $_a as $aRow )
			$a[] = $aRow[$_sCol];
		return $a;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// MySQL.php

define('SQL_LOG_ERRORS', DEBUG);

define('LOG_LF', "\n");
define('LOG_SEPR',     ' | ');

define('DEFAULT_QUERY_TYPE', 'buffered');   //  buffered, unbuffered



class CMySQL
{
	var $aCfg           = array();
	var $Link           = null;
	var $SelectedDBName = null;

	var $sCurQuery      = null;

  //
	
	function __construct( $aCfg )
	{
		$this->aCfg = $aCfg;
	}

	/**
	* Initialize connection
	*/
	function Init()
	{
		$this->Connect();
		
    if ( isset($this->aCfg['DBName']) )
      $this->SelectDB();
    
		if ( isset($this->aCfg['Charset']) && strlen($this->aCfg['Charset']) )
      $this->Query("SET NAMES {$this->aCfg['Charset']}");
	}

	/**
	* Open connection
	*/
	function Connect( $_bException = true )
	{
		$bPersistent = isset($this->aCfg['Persistent']) && $this->aCfg['Persistent'];
		
		$this->sCurQuery = ($bPersistent ? 'p' : '') . "connect to: {$this->aCfg['Host']}";
		
    $Fn = ($bPersistent) ? 'mysql_pconnect' : 'mysql_connect';

		$this->Link = $Fn($this->aCfg['Host'], $this->aCfg['User'], $this->aCfg['Password']);
		if ( ! $this->Link && $_bException )
    	throw new CDBException(CDBException::CouldNotConnect);
	
		register_shutdown_function(array(&$this, 'Close'));
    
    $this->sCurQuery = null;
    
    return (bool) $this->Link;
	}

	/**
	* Select database
	*/
	function SelectDB( $_sName = null, $_bException = true )
	{
		$sName = isset($_sName) ? $_sName : $this->aCfg['DBName'];
    
    $this->sCurQuery = "select db: $sName";
		
    $b = mysql_select_db($sName, $this->Link);
    if ( ! $b && $_bException )
      throw new CDBException($this->Error(), $this->sCurQuery);

		$this->SelectedDBName = $sName;
    
    $this->sCurQuery = null;
    
    return $b;
	}

	/**
	* Base query method
	*/
	protected function _Query( $_sQuery, $_QueryType = DEFAULT_QUERY_TYPE )
	{
		if ( ! is_resource($this->Link) )
			$this->Init();
    
    $this->sCurQuery = $_sQuery;
		
		$Fn = ($_QueryType === 'unbuffered') ? 'mysql_unbuffered_query' : 'mysql_query';

		if ( ! $Res = $Fn($_sQuery, $this->Link) )
			$this->log_error();
    
    $this->sCurQuery = null;

		return $Res;
	}

	/**
	* Execute query WRAPPER (with error handling)
	*/
	function Query( $_sQuery, $_QueryType = DEFAULT_QUERY_TYPE )
	{
		if ( ! $Res = $this->_Query($_sQuery, $_QueryType) )
			throw new CDBException($this->Error(), $_sQuery);

		return new CDBResult($Res, $this->Link);
	}

  function FetchRow( $_sQuery, $_ResultType = MYSQL_ASSOC, $_QueryType = DEFAULT_QUERY_TYPE )
  {
    return $this->Query($_sQuery, $_QueryType)->FetchRow($_ResultType);
  }
  
  
  function FetchRowset( $_sQuery, $_ResultType = MYSQL_ASSOC, $_QueryType = DEFAULT_QUERY_TYPE )
  {
    $Res = $this->Query($_sQuery, $_QueryType);
    $a = array();
    while ( $aRow = $Res->FetchRow($_ResultType) )
      $a[] = $aRow;
    return $a;
  }
  
  
  function FetchArray( $_sQuery, $_QueryType = DEFAULT_QUERY_TYPE )
  {
    $Res = $this->Query($_sQuery, $_QueryType);
    $a = array();
    while ( $aRow = $Res->FetchRow(MYSQL_NUM) )
      $a[] = $aRow[0];
    return $a;
  }
	
  
  function FetchValue( $_sQuery, $_bException = false, $_QueryType = DEFAULT_QUERY_TYPE )
  {
    if ( ! $aRow = $this->FetchRow($_sQuery, MYSQL_NUM, $_QueryType) )
      if ( $_bException )
        throw new ErrorException('Rowset is empty', 0, 0);
      else
        return false;
    return $aRow[0];
  }
  
  
  function RowsetNotEmpty( $_sQuery, $_QueryType = DEFAULT_QUERY_TYPE )
  {
    return (bool) $this->FetchRow($_sQuery, MYSQL_NUM, $_QueryType);
  }
  
  
	/**
	* Get last inserted id after insert statement
	*/
	function InsertID()
	{
		return mysql_insert_id($this->Link);
	}

	/**
	* Escape data used in sql query
	*/
	function Escape( $v )
	{
		if ( $v instanceof CMySQL_RawString )
      return $v->s;
    
    switch (true) {
			case is_string ($v): return "'". $this->EscapeString($v) ."'";
			case is_int    ($v): return "$v";
			case is_bool   ($v): return ($v) ? '1' : '0';
			case is_float  ($v): return str_replace(',', '.', "'$v'");
			case is_null   ($v): return 'NULL';
		}
    
		throw ErrorException(__FUNCTION__ .' - wrong params', 0, 1);
	}

	/**
	* Escape string
	*/
	function EscapeString( $s ) {
		if ( ! is_resource($this->Link) )
			$this->Init();
    
		return mysql_real_escape_string($s);
	}

	function EscapeString_P( &$rs ) {
    $rs = $this->EscapeString($rs);
  }
  
	function EscapeString_Like( $s ) {
    return str_replace(array("_","%"), array("\_","\%"), $this->EscapeString($s));
  }

	function EscapeString_Like_P( &$rs ) {
    $rs = $this->EscapeString_Like($rs);
  }
  
  
	/**
	* Build SQL statement from array (based on same method from phpBB3, idea from Ikonboard)
	*
	* Possible $sQueryType values: INSERT, INSERT_SELECT, MULTI_INSERT, UPDATE, SELECT
	*/
	function BuildArray( $sQueryType, $aData, $bDontEscape = false )
	{
		$fields = $values = $a = $query = array();

		if ( empty($aData) || !is_array($aData) )
			throw ErrorException(__FUNCTION__ .' - wrong params: $aData', 0, 1);

		switch ( $sQueryType ) {
      case 'INSERT':
      case 'INSERT_SELECT':
        foreach ($aData as $field => $val) {
          $fields[] = "`$field`";
          $values[] = $bDontEscape ? $val : $this->Escape($val);
        }
        $fields = join(', ', $fields);
        $values = join(', ', $values);
        
        $query = $sQueryType == 'INSERT' ? "($fields)\nVALUES\n($values)" :
                                           "($fields)\nSELECT\n$values";
      break;
      
      case 'MULTI_INSERT': // todo: ``
        foreach ($aData as $id => $sql_ary) {
          foreach ($sql_ary as $field => $val)
            $values[] = $bDontEscape ? $val : $this->Escape($val);
          $a[] = '('. join(', ', $values) .')';
          $values = array();
        }
        $fields = join(', ', array_keys($aData[0]));
        $values = join(",\n", $a);
        $query = "($fields)\nVALUES\n$values";
      break;
      
      case 'SELECT':
      case 'UPDATE':
        foreach ($aData as $field => $val)
          $a[] = "`$field` = ". ($bDontEscape ? $val : $this->Escape($val));
        $glue = ($sQueryType == 'SELECT') ? "\nAND " : ",\n";
        $query = join($glue, $a);
      break;
      
      default:
        throw ErrorException(__FUNCTION__ .": Invalid query type '$sQueryType'");
		}

		//if ( ! $query )
    //  throw InvalidArgumentException(__FUNCTION__ .": Wrong params for $sQueryType query type\n\n\$aData:\n\n". htmlCHR(print_r($aData, true)) .'</pre>');

		return "\n". $query ."\n";
	}

	/**
	* Return sql error array
	*/
	function Error()
	{
		return self::S_Error($this->Link);
	}

	static function S_Error( $_Link )
	{
		return is_resource($_Link) ?
		  array( 'Code' => mysql_errno($_Link),
             'Msg' => mysql_error($_Link) ) :
      array( 'Code' => '',
             'Msg' => 'Not connected' );
	}

	
  
  /**
	* Close sql connection
	*/
	function Close()
	{
		if (is_resource($this->Link)) {
			mysql_close($this->Link);
		}

		$this->Link = $this->SelectedDBName = null;
	}


	/**
	* Find caller source
	*/
	function debug_find_source ($mode = '')
	{
		foreach (debug_backtrace() as $trace)
		{
			if (!empty($trace['file']) &&  $trace['file'] !== __FILE__)
			{
				switch ($mode)
				{
					case 'file': return $trace['file'];
					case 'line': return $trace['line'];
					//default: return hide_bb_path($trace['file']) .'('. $trace['line'] .')';
					default: return $trace['file'] .'('. $trace['line'] .')';
				}
			}
		}
		return '';
	}

	/**
	* Log error
	*/
	function log_error ()
	{
		if (!SQL_LOG_ERRORS) return;
		
		$msg = array();
		$err = $this->Error();
		$msg[] = str_compact(sprintf('#%06d %s', $err['Code'], $err['Msg']));
		$msg[] = '';
		$msg[] = str_compact($this->sCurQuery);
		$msg[] = '';
		$msg[] = 'Source  : '. $this->debug_find_source();
		$msg[] = 'IP      : '. @$_SERVER['REMOTE_ADDR'];
		$msg[] = 'Date    : '. date('Y-m-d H:i:s');
		$msg[] = 'Agent   : '. @$_SERVER['HTTP_USER_AGENT'];
		$msg[] = 'Req_URI : '. @$_SERVER['REQUEST_URI'];
		$msg[] = 'Referer : '. @$_SERVER['HTTP_REFERER'];
		$msg[] = 'Method  : '. @$_SERVER['REQUEST_METHOD'];
		$msg[] = 'PID     : '. sprintf('%05d', getmypid());
		$msg[] = 'Request : '. trim(print_r($_REQUEST, true)) . str_repeat('_', 78) . LOG_LF;
		$msg[] = '';
		LogMsg($msg, 'logs/SQL errors.log'); //todo
	}
}



class CDBResult
{
	protected $Res;
  protected $Link;
	
	
	
	function __construct( $Res, $Link )
	{
		$this->Res = $Res;
    $this->Link = $Link;
	}
	
	
	function FetchRow( $ResultType = MYSQL_ASSOC )
  {
		return mysql_fetch_array($this->Res, $ResultType);
  }
  
  
  function NumRows()
	{
		$i = mysql_num_rows($this->Res);
		if ( $i === false )
			throw new CDBException(CMySQL::Error($this->Link));
    return $i;
	}
}



class CDBException extends ErrorException
{
  public $aSqlError = array();
  public $Sql;
	
  const CouldNotConnect = 0;
  
  function __construct( $aSqlError, $Sql = null, $File = null, $Line = null ) {
    $this->aSqlError = $aSqlError;
    $this->Sql = $Sql;
    
    parent::__construct($this->aSqlError == self::CouldNotConnect ?
                          "Could not connect to server" :
                          "Error $aSqlError[Code]: $aSqlError[Msg]",
                        0, 1, $File, $Line);
  }
}



class CMySQL_RawString
{
  public $s;
  function __construct( $s ) { $this->s = $s; }
}



function str_compact ($str) {
	return preg_replace('#\s+#', ' ', trim($str));
}

function LogMsg($msg, $file_name) {
	if (is_array($msg))
		$msg = join(LOG_LF, $msg);
	error_log( $msg, 3, $file_name );
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// Exceptions.php

class CException_Unauthorized extends ErrorException
{
  function __construct( $sOperation, $File = null, $Line = null ) {
    parent::__construct("Нет права на выполнение операции '$sOperation'",
                        0, 0, $File, $Line);
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// ConfigFile.php

class CConfigFile
{
  protected $sFile;
  
  protected $sText = '';
  
  //
  
  public function __construct( $_sFile ) {
    $this->sFile = $_sFile;
  }
  
  
  public function AddLine( $_s ) {
    $this->sText .= $_s."\n";
  }
  
  
  public function AddParams( $_sVariableName, $_aParams ) {
    $sPrefix = '$'.$_sVariableName;
    foreach ( $_aParams as $k => $v )
      $this->sText .= $this->Encode($sPrefix, $k, $v, true);
  }
  
  
  public function Write() {
    if ( ! file_put_contents($this->sFile, "<?php\n\n$this->sText?>") )
      throw new ErrorException("Ошибка записи в файл \"$this->sFile\"", 0, 0);
  }
  
  //
  
  protected function Encode( $_sPrefix, $_Name, $_Val, $_bInsertEmptyLine = false ) {
    if ( is_array($_Val) ) {
      $_sPrefix .= "['$_Name']";
      foreach ( $_Val as $k => $v )
        $this->sText .= $this->Encode($_sPrefix, $k, $v);
      $this->sText .= "\n";
    }
    else {
      if ( is_string($_Val) )
        $_Val = "'$_Val'";
      return $_sPrefix."['$_Name'] = $_Val;\n" . ($_bInsertEmptyLine ? "\n" : '');
    }
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// Installer.php

class CInstaller
{
  public static $aDefaultConfig = array(
    'SiteTitle' => 'Гостевая книга - Хованский А. О.',
    'NumMsgsOnPage' => 10,
    'Template' => 'default',
    'FileSystemEncoding' => 'UTF-8'
  );
  
  //
  
  public function CheckInstall() {
    global $config, $DB, $g_User;
    
    $Ret = array();
    $aErrors = array();
    
    if ( ! file_exists(ROOT."config.php") ) {
      $Ret['Install']['Installed'] = false;
      $Ret['Ok'] = true;
      return $Ret;
    }
    
    $Ret['Install']['Installed'] = true;
    
    $config = array();
    require ROOT."config.php";
    
    if ( isset($config['DB']['Host']) && $config['DB']['Host'] )
      $Ret['Install']['Config']['DB_Host'] = $config['DB']['Host'];
    else
      $aErrors[] = "Не задан хост БД (config.php: \$config['DB']['Host'])";
    if ( isset($config['DB']['User']) && $config['DB']['User'] )
      $Ret['Install']['Config']['DB_User'] = $config['DB']['User'];
    else
      $aErrors[] = "Не задан логин для БД (config.php: \$config['DB']['User'])";
    if ( isset($config['DB']['Password']) && $config['DB']['Password'] )
      $Ret['Install']['Config']['DB_Password'] = $config['DB']['Password'];
    else
      $aErrors[] = "Не задан пароль для БД (config.php: \$config['DB']['Password'])";
    if ( isset($config['DB']['DBName']) && $config['DB']['DBName'] )
      $Ret['Install']['Config']['DB_DBName'] = $config['DB']['DBName'];
    else
      $aErrors[] = "Не задано имя БД (config.php: \$config['DB']['DBName'])";
    
    if ( $aErrors ) {
      $Ret['Install']['Errors'] = $aErrors;
      $Ret['Ok'] = true;
      return $Ret;
    }      
    
    $DB = new CMySQL(array(
      'Host'     => $config['DB']['Host'],
      'User'     => $config['DB']['User'],
      'Password' => $config['DB']['Password'],
      'DBName'   => $config['DB']['DBName'],
      'Charset'  => 'utf8'
    ));
    unset( $config['DB']['Password'] );
    
    try {
      $DB->Init();
    }
    catch( CDBException $e ) {
      $Ret['Install']['Errors'] =
        "Невозможно инициализировать подключение к БД: ". $e->getMessage();
      $Ret['Ok'] = true;
      return $Ret;
    }
    
    $Admin = CUser::GetAdmin();
    if ( $Admin ) {
      if ( isset($_SESSION['Login']) && isset($_SESSION['Password']) &&
           $_SESSION['Login'] == $Admin->Login &&
           md5($_SESSION['Password']) == $Admin->Password )
        $g_User = $Admin;
      else
        throw new CException_Unauthorized(__FUNCTION__);
    }
    else
      $aErrors[] = "Отсутствует аккаунт администратора";
    
    if ( ! CUser::Get('guest', 'guest') )
      $aErrors[] = "Отсутствует гостевой аккаунт (guest)";
    
    if ( $aErrors ) {
      $Ret['Install']['Errors'] = $aErrors;
      $Ret['Ok'] = true;
      return $Ret;
    }
    
    $Ret['Install']['InstallOk'] = true;
    
    
    $aConfig = $config;
    unset($aConfig['DB']);
    CArray::S_Merge($Ret['Install']['Config'], $aConfig);
    
    
    $Ret['Ok'] = true;
    return $Ret;
  }
  
  
  
  public function Install( $_aParams ) {
    global $config, $DB, $g_User;
    
    $aRet = array();
    
    if ( ! CUser::Valid('Login', $_aParams['AdminLogin']) )
      $aRet['Errors'][] = "Недопустимое значение логина аккаунта администратора";
    if ( ! CUser::Valid('Password', $_aParams['AdminPassword']) )
      $aRet['Errors'][] = "Недопустимое значение пароля аккаунта администратора";
    if ( isset($aRet['Errors']) )
      return $aRet;
    
    $sLog = '';
    
    try {
      $sLog .= "Подключение к серверу БД ... ";
      
      $DB = new CMySQL(array(
        'Host'     => $_aParams['DB_Host'],
        'User'     => $_aParams['DB_User'],
        'Password' => $_aParams['DB_Password'],
        'Charset'  => 'utf8'
      ));
      
      $DB->Init();
      
      $sLog .= "ok\n";
      
      
      $sLog .= "Создание БД $_aParams[DB_DBName] ... ";
      $DB->Query("CREATE DATABASE `$_aParams[DB_DBName]`".
                 " DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci");
      $sLog .= "ok\n";
      
      $sLog .= "Выбор БД $_aParams[DB_DBName] ... ";
      $DB->SelectDB($_aParams['DB_DBName']);
      $sLog .= "ok\n";
      
      $sLog .= "Создание таблицы `messages` ... ";
      $DB->Query( <<<EOT
CREATE TABLE `messages` (
  `ID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` mediumint(8) unsigned NOT NULL,
  `CreateTimestamp` int(10) unsigned NOT NULL,
  `LastEditTimestamp` int(10) unsigned NOT NULL,
  `Text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
EOT
      );
      $sLog .= "ok\n";
      
      $sLog .= "Создание таблицы `users` ... ";
      $DB->Query( <<<EOT
CREATE TABLE `users` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Login` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `Password` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `Group` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login_UNIQUE` (`Login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
EOT
      );
      $sLog .= "ok\n";
      
      
      $sLog .= "Создание гостевого аккаунта ... ";
      
      $User = new CUser();
      $User->Login = 'guest';
      $User->Password = 'guest';
      $User->Group = CUser::Guest;
      $User->Save($DB);
      
      $sLog .= "ok\n";
      
      
      $sLog .= "Создание аккаунта администратора... ";
      
      $User = new CUser();
      $User->Login = $_aParams['AdminLogin'];
      $User->Password = $_aParams['AdminPassword'];
      $User->Group = CUser::Admin;
      $User->Save($DB);
      
      $sLog .= "ok\n";
      
      
      $sLog .= "Запись конфигурационного файла config.php ... ";
      
      $config = array_merge(
        array('DB' => array('Host' => $_aParams['DB_Host'],
                            'User' => $_aParams['DB_User'],
                            'Password' => $_aParams['DB_Password'],
                            'DBName' => $_aParams['DB_DBName']) ),
        self::$aDefaultConfig );
      unset($_aParams['DB_Password']);
      
      $Config = new CConfigFile(ROOT."config.php");
      $Config->AddParams('config', $config);
      $Config->Write();
      
      $sLog .= "ok\n";
      
      $sLog .= "Установка завершена.";
      
      
      $_SESSION['Login'] = $_aParams['AdminLogin'];
      $_SESSION['Password'] = $_aParams['AdminPassword'];
      unset($_aParams['AdminPassword']);
      
      $g_User = $User;
      
      $aRet['Ok'] = true;
    }
    catch ( Exception $e ) {
      $sLog .= DEBUG ? $e : $e->getMessage();
    }
    
    if ( DEBUG )
      file_put_contents('logs/install.log', $sLog, FILE_APPEND);
    
    $aRet['Log'] = $sLog;
    return $aRet;
  }
  
  
  
  public function SaveConfig( $_aParams ) {
    global $config, $g_User;
    
    if ( ! ($g_User && $g_User->Group == CUser::Admin) )
      throw new CException_Unauthorized(__FUNCTION__);
    
    // Re-read for DB password
    $config = array();
    require ROOT."config.php";
    
    foreach ( self::$aDefaultConfig as $sName => $vDefault )
      $config[$sName] = isset($_aParams[$sName]) && strlen($_aParams[$sName]) ?
                        $_aParams[$sName] : $vDefault;
    
    $Config = new CConfigFile(ROOT."config.php");
    $Config->AddParams('config', $config);
    $Config->Write();
    
    return true;
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// DBClass.php

class CDBClass
{
  protected $aData = array();
  
  protected $DB;
  
  protected static $aCols;
  
  //
  
  function __construct( $_v = null, $_DB = null ) {
    if ( is_array($_v) )
      $this->Load($_v);
    elseif ( isset($_v) )
      $this->aData['ID'] = (int) $_v;
    
    $this->DB = $_DB;
  }
  
	
  function __get( $_sField ) {
    if ( array_key_exists($_sField, $this->aData) )
      return $this->aData[$_sField];
    else
      throw new ErrorException("Property $_sField don't exist", 0, 0);
  }
  
  
  function __set( $_sField, $_v ) {
    $_v = static::Validate($_sField, $_v);
    
    $aField = static::$aFields[$_sField];
    if ( isset($aField['SetConversion']) )
      switch ( $aField['SetConversion'] ) {
        case 'md5': $_v = md5($_v);
      }
    
    $this->aData[$_sField] = $_v;
  }
  
  
  function Load( $_aDBRow = null ) {
		if ( $_aDBRow )
			foreach ( $_aDBRow as $sCol => $v ) {
				$sField = isset(static::$aCols[$sCol]) ? static::$aCols[$sCol] : $sCol;
				$this->LoadField_($sField, $v);
			}
		else
    if ( isset($this->aData['ID']) ) {
      $aRow = $this->DB->FetchRow(
        "SELECT * FROM ".static::$sTable." WHERE ID = ".$this->aData['ID']);
      if ( $aRow === false )
        throw new ErrorException($this->NotFoundMsg($this->aData['ID']), 0, 0);
      $this->Load($aRow);
    }
  }
  
  
  function Save( $_DB ) {
    $_DB->Query("INSERT INTO ".static::$sTable. $_DB->BuildArray('INSERT', $this->aData));
    return $_DB->InsertID();
  }
  
  
  function ToArray( $_aFields = null ) {
    if ( $_aFields ) {
      $a = array();
      foreach ( $_aFields as $sField )
        $a[$sField] = $this->__get($sField);
      return $a;
    }
    else
      return $this->aData;
  }
  
  //
	
	protected function LoadField( $_sField ) {
    $aField = static::$aFields[$_sField];
    $sCol = isset($aField['DBCol']) ? $aField['DBCol'] : $_sField;
    $v = $this->DB->FetchValue(
      "SELECT $sCol FROM ".static::$sTable." WHERE ID = ".$this->aData['ID'], true);
    $this->LoadField_($_sField, $v);
  }
  
  
  protected function LoadField_( $_sField, $_v ) {
    $aField = static::$aFields[$_sField];
    
    switch ( $aField['Type'] ) {
      case 's':
        if ( isset($aField['Trimmed']) && $aField['Trimmed'] )
          $_v = trim($_v);
      break;
      
      case 'i':
        settype($_v, 'int');
      break;
    }
    
    $this->aData[$_sField] = $_v;
  }
  
  
  protected function SaveDBFields( $_aFields ) {
    $this->DB->Query("UPDATE ".static::$sTable." SET". $this->DB->BuildArray('UPDATE', $_aFields) .
										 "WHERE ID = ".$this->aData['ID']);
  }
  
  protected function SaveDBField( $_sField, $_Val ) {
    $this->SaveDBFields(array($_sField => $_Val));
  }
  
  //
  
  static function InitStatic() {
    foreach ( static::$aFields as $sField => $aField ) {
      if ( isset($aField['DBCol']) )
        static::$aCols[$aField['DBCol']] = $sField;
    }
  }
  
  
  static function Validate( $_sField, $_v ) {
    if ( ! isset(static::$aFields[$_sField]) )
      throw new ErrorException(__FUNCTION__.": Unknown field '$_sField'");
    
    $aField = static::$aFields[$_sField];
    
    switch ( $aField['Type'] ) {
      case 's':
        settype($_v, 'string');
        if ( isset($aField['MinLen']) && mb_strlen($_v) < $aField['MinLen'] ||
             isset($aField['MaxLen']) && mb_strlen($_v) > $aField['MaxLen'] ||
             isset($aField['CharRepertoire']['RegExp']) &&
               ! preg_match($aField['CharRepertoire']['RegExp'].'u', $_v) )
          throw new ErrorException("Invalid property value: $_sField: $_v", 0, 0);
      break;
      
      case 'i':
        settype($_v, 'int');
      break;
      
      default:
        throw new ErrorException(__FUNCTION__.": Unknown property type: $_sField: $aField[Type]");
    }
    
    return $_v;
  }
  
  
  static function Valid( $_sField, $_v ) {
    try { static::Validate($_sField, $_v); } catch( Exception $e ) { return false; }
    return true;
  }
  
  
  static function ValidationRules( $_sField ) {
    if ( ! isset(static::$aFields[$_sField]) )
      throw new ErrorException(__FUNCTION__.": Unknown field '$_sField'");
    return static::$aFields[$_sField];
  }
  
  
  static function DBColumns_S() {
    $aFields = func_get_args();
    if ( ! $aFields || $aFields[0] === null )
      $aFields = array_keys(static::$aFields);
    elseif ( is_array($aFields[0]) )
      $aFields = $aFields[0];
    
    $aCols = array();
    foreach ( $aFields as $sField ) {
      $aField = static::$aFields[$sField];
      $aCols[] = '`'. (isset($aField['DBCol']) ? $aField['DBCol'] : $sField) .'`';
    }
    return join(',', $aCols);
  }
  
  
  static function Get_Rowset( $_aRows, $_aFields = null ) {
    foreach ( $_aRows as &$r ) {
      $sClass = get_called_class();
      $Instance = new $sClass($r);
      $r = $Instance->ToArray($_aFields);
    }
    return $_aRows;
  }
  
  
  static function Get_IDs( $_aIDs, $_aFields = null ) {
    if ( ! $_aIDs )
      return array();
    
    global $DB;
    
    $sCols = static::DBColumns_S($_aFields);
    $sIDs = join(',', $_aIDs);
    
    $aRows = $DB->FetchRowset("SELECT $sCols FROM ".static::$sTable." WHERE ID IN ($sIDs)");
    
    return static::Get_Rowset($aRows, $_aFields);
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// User.php

class CUser extends CDBClass
{
  // Keep in sync with index.php
  const Guest = 0;
  const User = 1;
  const Admin = 2;
  
  protected static $aFields = array(
    'ID' => array('Type' => 'i'),
    'Login' => array('Type' => 's',
                     'MinLen' => 1, 'MaxLen' => 30,
                     'CharRepertoire' => array(
                       'RegExp' => '/^\w+$/')),
    'Password' => array('Type' => 's',
                        'MinLen' => 5, 'MaxLen' => 16,
                        'CharRepertoire' => array(
                          'RegExp' => '/^\w+$/'),
                        'SetConversion' => 'md5'),
    'Group' => array('Type' => 'i')
  );
  
  protected static $sTable = 'users';
  
  //
  
  function ToArray( $_aFields = null ) {
    if ( $_aFields ) {
      $a = array();
      foreach ( $_aFields as $sField )
        $a[$sField] = $this->__get($sField);
      return $a;
    }
    else {
      $a = $this->aData;
      unset($a['Password']);
      return $a;
    }
  }
  
  //
  
  static function Get( $_sLogin, $_sPass ) {
    global $DB;
    
    if ( ! (isset($_sLogin) && isset($_sPass)) )
      return null;
    
    $DB->EscapeString_P($_sLogin);
    $a = $DB->FetchRow("SELECT * FROM users WHERE Login='$_sLogin'");
    
    return $a && md5($_sPass) == $a['Password'] ? new CUser($a, $DB) : null;
  }
  
  
  static function GetByLogin( $_sLogin ) {
    global $DB;
    
    $DB->EscapeString_P($_sLogin);
    $a = $DB->FetchRow("SELECT * FROM users WHERE Login='$_sLogin'");
    return $a ? new CUser($a) : null;
  }
  
  
  static function GetAdmin() {
    global $DB;
    
    $a = $DB->FetchRow("SELECT * FROM users WHERE `Group`=".self::Admin);
    return $a ? new CUser($a) : null;
  }
}

CUser::InitStatic();

////////////////////////////////////////////////////////////////////////////////////////////////////
// Msg.php

class CMsg extends CDBClass
{
  protected static $aFields = array(
    'ID' => array('Type' => 'i'),
    'UserID' => array('Type' => 'i'),
    'CreateTimestamp' => array('Type' => 'i'),
    'LastEditTimestamp' => array('Type' => 'i'),
    'Text' => array('Type' => 's')
  );
  
  protected static $sTable = 'messages';
  
  //
  
  public function SetSaveField( $_sField, $_Val ) {
    global $g_User;
    
    if ( ! in_array($_sField, array('Text')) )
      throw new ErrorException(__FUNCTION__.": Invalid field: $_sField", 0, 0);
    
    $this->LoadField('UserID');
    
    if ( ! ($g_User && $this->aData['UserID'] == $g_User->ID ||
						HasRight($g_User, '', 'EditOthersMsgs')) )
      throw new CException_Unauthorized(__FUNCTION__);
    
    $_Val = static::Validate($_sField, $_Val);
		
		$this->SaveDBField($_sField, $_Val);
    
    return true;
  }
}

CMsg::InitStatic();

////////////////////////////////////////////////////////////////////////////////////////////////////
// rights.php

function HasRight( $_User, $_sClass, $_sFunction ) {
  if ( ! $_User )
    return false;
  
  switch ( $_sClass ) {
    case '':
      switch ( $_sFunction ) {
        case 'Register':
        case 'LogIn':
        case 'LogOut':
        case 'GetMsgs':
          return true;
        
        case 'PostMsg':
        case 'ChangeMsg':
        case 'DeleteMsg':
        case 'UploadFile':
          return $_User->Group == CUser::User || $_User->Group == CUser::Admin;
        
        case 'EditOthersMsgs':
        case 'DeleteOthersMsgs':
        case 'ExtendedErrorInfo':
          return $_User->Group == CUser::Admin;
      }
  }
  
  return false;
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// JsHttpRequest.php

/**
 * JsHttpRequest: PHP backend for JavaScript DHTML loader.
 * (C) Dmitry Koterov, http://en.dklab.ru
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * See http://www.gnu.org/copyleft/lesser.html
 *
 * Do not remove this comment if you want to use the script!
 * Не удаляйте данный комментарий, если вы хотите использовать скрипт!
 *
 * This backend library also supports POST requests additionally to GET.
 *
 * @author Dmitry Koterov 
 * @version 5.x $Id$
 */

class JsHttpRequest
{
    //var $SCRIPT_ENCODING = "windows-1251";
    var $SCRIPT_DECODE_MODE = '';
    var $LOADER = null;
    var $ID = null;    
    var $RESULT = null;
    
    // Internal; uniq value.
    var $_uniqHash;
    // Magic number for display_error checking.
    var $_magic = 14623;
    // Previous display_errors value.
    var $_prevDisplayErrors = null;    
    // Internal: response content-type depending on loader type.
    var $_contentTypes = array(
        //"script" => "text/javascript",
        "xml"    => "application/json", // In XMLHttpRequest mode we must return text/plain - stupid Opera 8.0. :(
        "form"   => "text/html",
        //""       => "text/plain", // for unknown loader
    );
    // Internal: conversion to UTF-8 JSON cancelled because of non-ascii key.
    var $_toUtfFailed = false;
    // Internal: list of characters 128...255 (for strpbrk() ASCII check).
    var $_nonAsciiChars = '';
    // Which Unicode conversion function is available?
    var $_unicodeConvMethod = null;
    // Emergency memory buffer to be freed on memory_limit error.
    var $_emergBuffer = null;

    
    /**
     * Constructor.
     * 
     * Create new JsHttpRequest backend object and attach it
     * to script output buffer. As a result - script will always return
     * correct JavaScript code, even in case of fatal errors.
     *
     * QUERY_STRING is in form of: PHPSESSID=<sid>&a=aaa&b=bbb&JsHttpRequest=<id>-<loader>
     * where <id> is a request ID, <loader> is a loader name, <sid> - a session ID (if present), 
     * PHPSESSID - session parameter name (by default = "PHPSESSID").
     * 
     * If an object is created WITHOUT an active AJAX query, it is simply marked as
     * non-active. Use statuc method isActive() to check.
     */
    function JsHttpRequest($enc)
    {
        global $JsHttpRequest_Active;
        
        // To be on a safe side - do not allow to drop reference counter on ob processing.
        $GLOBALS['_RESULT'] =& $this->RESULT; 
        
        $_SERVER['QUERY_STRING'] = preg_replace('/^&+|&+$/s', '', preg_replace('/(^|&)'.session_name().'=[^&]*&?/s', '&', $_SERVER['QUERY_STRING']));
        
        $this->LOADER = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ?
            'xml' : 'form';
        
        unset(
            $_GET['JsHttpRequest'],
            $_REQUEST['JsHttpRequest'],
            $_GET[session_name()],
            $_POST[session_name()],
            $_REQUEST[session_name()]
        );
        // Detect Unicode conversion method.
        $this->_unicodeConvMethod = function_exists('mb_convert_encoding')? 'mb' : (function_exists('iconv')? 'iconv' : null);

        // Fill an emergency buffer. We erase it at the first line of OB processor
        // to free some memory. This memory may be used on memory_limit error.
        $this->_emergBuffer = str_repeat('a', 1024 * 200);

        // Intercept fatal errors via display_errors (seems it is the only way).     
        $this->_uniqHash = md5('JsHttpRequest' . microtime() . getmypid());
        $this->_prevDisplayErrors = ini_get('display_errors');
        ini_set('display_errors', $this->_magic); //
        ini_set('error_prepend_string', $this->_uniqHash . ini_get('error_prepend_string'));
        ini_set('error_append_string',  ini_get('error_append_string') . $this->_uniqHash);
        if (function_exists('xdebug_disable')) xdebug_disable(); // else Fatal errors are not catched

        // Start OB handling early.
        ob_start(array(&$this, "_obHandler"));
        $JsHttpRequest_Active = true;

        // Set up the encoding.
        $this->setEncoding($enc);

        // Check if headers are already sent (see Content-Type library usage).
        // If true - generate a debug message and exit.
        $file = $line = null;
        $headersSent = version_compare(PHP_VERSION, "4.3.0") < 0? headers_sent() : headers_sent($file, $line);
        if ($headersSent) {
            trigger_error(
                "HTTP headers are already sent" . ($line !== null? " in $file on line $line" : " somewhere in the script") . ". "
                . "Possibly you have an extra space (or a newline) before the first line of the script or any library. "
                . "Please note that JsHttpRequest uses its own Content-Type header and fails if "
                . "this header cannot be set. See header() function documentation for more details",
                E_USER_ERROR
            );
            exit();
        }
    }
    

    /**
     * Static function.
     * Returns true if JsHttpRequest output processor is currently active.
     * 
     * @return boolean    True if the library is active, false otherwise.
     */
    function isActive()
    {
        return !empty($GLOBALS['JsHttpRequest_Active']);
    }
    

    /**
     * string getJsCode()
     * 
     * Return JavaScript part of the library.
     */
    function getJsCode()
    {
        return file_get_contents(dirname(__FILE__) . '/JsHttpRequest.js');
    }


    /**
     * void setEncoding(string $encoding)
     * 
     * Set an active script encoding & correct QUERY_STRING according to it.
     * Examples:
     *   "windows-1251"          - set plain encoding (non-windows characters, 
     *                             e.g. hieroglyphs, are totally ignored)
     *   "windows-1251 entities" - set windows encoding, BUT additionally replace:
     *                             "&"         ->  "&amp;" 
     *                             hieroglyph  ->  &#XXXX; entity
     */
    function setEncoding($enc)
    {
        // Parse an encoding.
        preg_match('/^(\S*)(?:\s+(\S*))$/', $enc, $p);
        $this->SCRIPT_ENCODING    = strtolower(!empty($p[1])? $p[1] : $enc);
        $this->SCRIPT_DECODE_MODE = !empty($p[2])? $p[2] : '';
        // Manually parse QUERY_STRING because of damned Unicode's %uXXXX.
        $this->_correctSuperglobals();
    }

    
    /**
     * string quoteInput(string $input)
     * 
     * Quote a string according to the input decoding mode.
     * If entities are used (see setEncoding()), no '&' character is quoted,
     * only '"', '>' and '<' (we presume that '&' is already quoted by
     * an input reader function).
     *
     * Use this function INSTEAD of htmlspecialchars() for $_GET data 
     * in your scripts.
     */
    function quoteInput($s)
    {
        if ($this->SCRIPT_DECODE_MODE == 'entities')
            return str_replace(array('"', '<', '>'), array('&quot;', '&lt;', '&gt;'), $s);
        else
            return htmlspecialchars($s);
    }
    

    /**
     * Convert a PHP scalar, array or hash to JS scalar/array/hash. This function is 
     * an analog of json_encode(), but it can work with a non-UTF8 input and does not 
     * analyze the passed data. Output format must be fully JSON compatible.
     * 
     * @param mixed $a   Any structure to convert to JS.
     * @return string    JavaScript equivalent structure.
     */
    function php2js($a=false)
    {
        if (is_null($a)) return 'null';
        if ($a === false) return 'false';
        if ($a === true) return 'true';
        if (is_scalar($a)) {
            if (is_float($a)) {
                // Always use "." for floats.
                $a = str_replace(",", ".", strval($a));
            }
            // All scalars are converted to strings to avoid indeterminism.
            // PHP's "1" and 1 are equal for all PHP operators, but 
            // JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
            // we should get the same result in the JS frontend (string).
            // Character replacements for JSON.
            static $jsonReplaces = array(
                array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
                array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"')
            );
            return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
        }
        $isList = true;
        for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
            if (key($a) !== $i) { 
                $isList = false; 
                break; 
            }
        }
        $result = array();
        if ($isList) {
            foreach ($a as $v) {
                $result[] = JsHttpRequest::php2js($v);
            }
            return '[ ' . join(', ', $result) . ' ]';
        } else {
            foreach ($a as $k => $v) {
                $result[] = JsHttpRequest::php2js($k) . ': ' . JsHttpRequest::php2js($v);
            }
            return '{ ' . join(', ', $result) . ' }';
        }
    }
    
        
    /**
     * Internal methods.
     */

    /**
     * Parse & decode QUERY_STRING.
     */
    function _correctSuperglobals()
    {
        // In case of FORM loader we may go to nirvana, everything is already parsed by PHP.
        if ($this->LOADER == 'form') return;
        
        // ATTENTION!!!
        // HTTP_RAW_POST_DATA is only accessible when Content-Type of POST request
        // is NOT default "application/x-www-form-urlencoded"!!!
        // Library frontend sets "application/octet-stream" for that purpose,
        // see JavaScript code. In PHP 5.2.2.HTTP_RAW_POST_DATA is not set sometimes; 
        // in such cases - read the POST data manually from the STDIN stream.
        $rawPost = strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0? (isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : @file_get_contents("php://input")) : null;
        $source = array(
            '_GET' => !empty($_SERVER['QUERY_STRING'])? $_SERVER['QUERY_STRING'] : null, 
            '_POST'=> $rawPost,
        );
        foreach ($source as $dst=>$src) {
            // First correct all 2-byte entities.
            $s = preg_replace('/%(?!5B)(?!5D)([0-9a-f]{2})/si', '%u00\\1', $src);
            // Now we can use standard parse_str() with no worry!
            $data = null;
            parse_str($s, $data);
            $GLOBALS[$dst] = $this->_ucs2EntitiesDecode($data);
        }
        $GLOBALS['HTTP_GET_VARS'] = $_GET; // deprecated vars
        $GLOBALS['HTTP_POST_VARS'] = $_POST;
        $_REQUEST = 
            (isset($_COOKIE)? $_COOKIE : array()) + 
            (isset($_POST)? $_POST : array()) + 
            (isset($_GET)? $_GET : array());
        if (ini_get('register_globals')) {
            // TODO?
        }
    }


    /**
     * Called in case of error too!
     */
    function _obHandler($text)
    {
        unset($this->_emergBuffer); // free a piece of memory for memory_limit error
        unset($GLOBALS['JsHttpRequest_Active']);
        
        // Check for error & fetch a resulting data.
        $wasFatalError = false;
        if (preg_match_all("/{$this->_uniqHash}(.*?){$this->_uniqHash}/sx", $text, $m)) {
            // Display_errors:
            // 1. disabled manually after the library initialization, or
            // 2. was initially disabled and is not changed
            $needRemoveErrorMessages = !ini_get('display_errors') || (!$this->_prevDisplayErrors && ini_get('display_errors') == $this->_magic);
            foreach ($m[0] as $error) {
                if (preg_match('/\bFatal error(<.*?>)?:/i', $error)) {
                    $wasFatalError = true;
                }
                if ($needRemoveErrorMessages) {
                    $text = str_replace($error, '', $text); // strip the whole error message
                } else {
                    $text = str_replace($this->_uniqHash, '', $text);
                }
            }
        }
        if ($wasFatalError) {
            // On fatal errors - force "null" result. This is needed, because $_RESULT
            // may not be fully completed at the moment of the error.
            $this->RESULT = null;
        } else {
            // Read the result from globals if not set directly.
            if (!isset($this->RESULT)) {
                global $_RESULT;
                $this->RESULT = $_RESULT;
            }
            // Avoid manual NULLs in the result (very important!).
            if ($this->RESULT === null) {
                $this->RESULT = false;
            }
        }
        
        // Note that 500 error is generated when a PHP error occurred.
        $status = $this->RESULT === null? 500 : 200;
        $result = array(
            'js'   => $this->RESULT,  // null always means a fatal error...
            'text' => $text,          // ...independent on $text!!!
        );
        $encoding = $this->SCRIPT_ENCODING;
        $text = null; // to be on a safe side
        
        // Try to use very fast json_encode: 3-4 times faster than a manual encoding.
        if (function_exists('array_walk_recursive') && function_exists('json_encode') && $this->_unicodeConvMethod) {
            $this->_nonAsciiChars = join("", array_map('chr', range(128, 255)));
            $this->_toUtfFailed = false;
            $resultUtf8 = $result;
            array_walk_recursive($resultUtf8, array(&$this, '_toUtf8_callback'), $this->SCRIPT_ENCODING);
            if (!$this->_toUtfFailed) {
                // If some key contains non-ASCII character, convert everything manually.
                $text = json_encode($resultUtf8);
                $encoding = "UTF-8";
            }
        }
        
        // On failure, use manual encoding.
        if ($text === null) {
            $text = $this->php2js($result);
        }

        //if ($this->LOADER != "xml") {
        //    // In non-XML mode we cannot use plain JSON. So - wrap with JS function call.
        //    // If top.JsHttpRequestGlobal is not defined, loading is aborted and 
        //    // iframe is removed, so - do not call dataReady().
        //    $text = "" 
        //        . ($this->LOADER == "form"? 'top && top.JsHttpRequestGlobal && top.JsHttpRequestGlobal' : 'JsHttpRequest') 
        //        . ".dataReady(" . $text . ")\n"
        //        . "";
        //    if ($this->LOADER == "form") {
        //        $text = '<script type="text/javascript" language="JavaScript"><!--' . "\n$text" . '//--></script>';
        //    }
        //    
        //    // Always return 200 code in non-XML mode (else SCRIPT does not work in FF).
        //    // For XML mode, 500 code is okay.
        //    $status = 200;
        //}

        // Status header. To be safe, display it only in error mode. In case of success 
        // termination, do not modify the status (""HTTP/1.1 ..." header seems to be not
        // too cross-platform).
        if ($this->RESULT === null) {
            if (php_sapi_name() == "cgi") {
                header("Status: $status");
            } else {
                header("HTTP/1.1 $status");
            }
        }

        $ctype = $this->_contentTypes[$this->LOADER];
        header("Content-type: $ctype; charset=$encoding");

        return $text;
    }


    /**
     * Internal function, used in array_walk_recursive() before json_encode() call.
     * If a key contains non-ASCII characters, this function sets $this->_toUtfFailed = true,
     * becaues array_walk_recursive() cannot modify array keys.
     */
    function _toUtf8_callback(&$v, $k, $fromEnc)
    {
        if ($v === null || is_bool($v)) return;
        
        // Представление дробей функцией json_encode зависит от локали, но менять ее (на "C") нежелательно.
        // Поэтому для дробей ставим флаг _toUtfFailed, чтобы использовался наш кодер.
        if ($this->_toUtfFailed || !is_scalar($v) || strpbrk($k, $this->_nonAsciiChars) !== false || is_float($v)) {
            $this->_toUtfFailed = true;
        } else {
            $v = $this->_unicodeConv($fromEnc, 'UTF-8', $v);
        }
    }
    

    /**
     * Decode all %uXXXX entities in string or array (recurrent).
     * String must not contain %XX entities - they are ignored!
     */
    function _ucs2EntitiesDecode($data)
    {
        if (is_array($data)) {
            $d = array();
            foreach ($data as $k=>$v) {
                $d[$this->_ucs2EntitiesDecode($k)] = $this->_ucs2EntitiesDecode($v);
            }
            return $d;
        } else {
            if (strpos($data, '%u') !== false) { // improve speed
                $data = preg_replace_callback('/%u([0-9A-F]{1,4})/si', array(&$this, '_ucs2EntitiesDecodeCallback'), $data);
            }
            return $data;
        }
    }


    /**
     * Decode one %uXXXX entity (RE callback).
     */
    function _ucs2EntitiesDecodeCallback($p)
    {
        $hex = $p[1];
        $dec = hexdec($hex);
        if ($dec === "38" && $this->SCRIPT_DECODE_MODE == 'entities') {
            // Process "&" separately in "entities" decode mode.
            $c = "&amp;";
        } else {
            if ($this->_unicodeConvMethod) {
                $c = @$this->_unicodeConv('UCS-2BE', $this->SCRIPT_ENCODING, pack('n', $dec));
            } else {
                $c = $this->_decUcs2Decode($dec, $this->SCRIPT_ENCODING);
            }
            if (!strlen($c)) {
                if ($this->SCRIPT_DECODE_MODE == 'entities') {
                    $c = '&#' . $dec . ';';
                } else {
                    $c = '?';
                }
            }
        }
        return $c;
    }


    /**
     * Wrapper for iconv() or mb_convert_encoding() functions.
     * This function will generate fatal error if none of these functons available!
     * 
     * @see iconv()
     */
    function _unicodeConv($fromEnc, $toEnc, $v)
    {
        if ($this->_unicodeConvMethod == 'iconv') {
            return iconv($fromEnc, $toEnc, $v);
        } 
        return mb_convert_encoding($v, $toEnc, $fromEnc);
    }


    /**
     * If there is no ICONV, try to decode 1-byte characters and UTF-8 manually
     * (for most popular charsets only).
     */
     
    /**
     * Convert from UCS-2BE decimal to $toEnc.
     */
    function _decUcs2Decode($code, $toEnc)
    {
        // Little speedup by using array_flip($this->_encTables) and later hash access.
        static $flippedTable = null;
        if ($code < 128) return chr($code);
        
        if (isset($this->_encTables[$toEnc])) {
            if (!$flippedTable) $flippedTable = array_flip($this->_encTables[$toEnc]);
            if (isset($flippedTable[$code])) return chr(128 + $flippedTable[$code]);
        } else if ($toEnc == 'utf-8' || $toEnc == 'utf8') {
            // UTF-8 conversion rules: http://www.cl.cam.ac.uk/~mgk25/unicode.html
            if ($code < 0x800) {
                return chr(0xC0 + ($code >> 6)) . 
                       chr(0x80 + ($code & 0x3F));
            } else { // if ($code <= 0xFFFF) -- it is almost always so for UCS2-BE
                return chr(0xE0 + ($code >> 12)) .
                       chr(0x80 + (0x3F & ($code >> 6))) .
                       chr(0x80 + ($code & 0x3F));
            }
        }
        
        return "";
    }
    

    /**
     * UCS-2BE -> 1-byte encodings (from #128).
     */
    var $_encTables = array(
        'windows-1251' => array(
            0x0402, 0x0403, 0x201A, 0x0453, 0x201E, 0x2026, 0x2020, 0x2021,
            0x20AC, 0x2030, 0x0409, 0x2039, 0x040A, 0x040C, 0x040B, 0x040F,
            0x0452, 0x2018, 0x2019, 0x201C, 0x201D, 0x2022, 0x2013, 0x2014,
            0x0098, 0x2122, 0x0459, 0x203A, 0x045A, 0x045C, 0x045B, 0x045F,
            0x00A0, 0x040E, 0x045E, 0x0408, 0x00A4, 0x0490, 0x00A6, 0x00A7,
            0x0401, 0x00A9, 0x0404, 0x00AB, 0x00AC, 0x00AD, 0x00AE, 0x0407,
            0x00B0, 0x00B1, 0x0406, 0x0456, 0x0491, 0x00B5, 0x00B6, 0x00B7,
            0x0451, 0x2116, 0x0454, 0x00BB, 0x0458, 0x0405, 0x0455, 0x0457,
            0x0410, 0x0411, 0x0412, 0x0413, 0x0414, 0x0415, 0x0416, 0x0417,
            0x0418, 0x0419, 0x041A, 0x041B, 0x041C, 0x041D, 0x041E, 0x041F,
            0x0420, 0x0421, 0x0422, 0x0423, 0x0424, 0x0425, 0x0426, 0x0427,
            0x0428, 0x0429, 0x042A, 0x042B, 0x042C, 0x042D, 0x042E, 0x042F,
            0x0430, 0x0431, 0x0432, 0x0433, 0x0434, 0x0435, 0x0436, 0x0437,
            0x0438, 0x0439, 0x043A, 0x043B, 0x043C, 0x043D, 0x043E, 0x043F,
            0x0440, 0x0441, 0x0442, 0x0443, 0x0444, 0x0445, 0x0446, 0x0447,
            0x0448, 0x0449, 0x044A, 0x044B, 0x044C, 0x044D, 0x044E, 0x044F,
        ),
        'koi8-r' => array(
            0x2500, 0x2502, 0x250C, 0x2510, 0x2514, 0x2518, 0x251C, 0x2524,
            0x252C, 0x2534, 0x253C, 0x2580, 0x2584, 0x2588, 0x258C, 0x2590,
            0x2591, 0x2592, 0x2593, 0x2320, 0x25A0, 0x2219, 0x221A, 0x2248,
            0x2264, 0x2265, 0x00A0, 0x2321, 0x00B0, 0x00B2, 0x00B7, 0x00F7,
            0x2550, 0x2551, 0x2552, 0x0451, 0x2553, 0x2554, 0x2555, 0x2556,
            0x2557, 0x2558, 0x2559, 0x255A, 0x255B, 0x255C, 0x255d, 0x255E,
            0x255F, 0x2560, 0x2561, 0x0401, 0x2562, 0x2563, 0x2564, 0x2565,
            0x2566, 0x2567, 0x2568, 0x2569, 0x256A, 0x256B, 0x256C, 0x00A9,
            0x044E, 0x0430, 0x0431, 0x0446, 0x0434, 0x0435, 0x0444, 0x0433,
            0x0445, 0x0438, 0x0439, 0x043A, 0x043B, 0x043C, 0x043d, 0x043E,
            0x043F, 0x044F, 0x0440, 0x0441, 0x0442, 0x0443, 0x0436, 0x0432,
            0x044C, 0x044B, 0x0437, 0x0448, 0x044d, 0x0449, 0x0447, 0x044A,
            0x042E, 0x0410, 0x0411, 0x0426, 0x0414, 0x0415, 0x0424, 0x0413,
            0x0425, 0x0418, 0x0419, 0x041A, 0x041B, 0x041C, 0x041d, 0x041E,
            0x041F, 0x042F, 0x0420, 0x0421, 0x0422, 0x0423, 0x0416, 0x0412,
            0x042C, 0x042B, 0x0417, 0x0428, 0x042d, 0x0429, 0x0427, 0x042A      
        ),
    );
}

////////////////////////////////////////////////////////////////////////////////////////////////////

if ( ! defined('C_sPacketQueryContextValue') )
  define('C_sPacketQueryContextValue', '_PacketQueryContextValue_');

mb_internal_encoding('UTF-8');


$bAdminMode = isset($_REQUEST['admin']) && $_REQUEST['admin'];

if ( $bAdminMode && ! isset($_REQUEST['Action']) ) {
  $config = array();
  $DB = null;
  $g_User = null;
  
  $Installer = new CInstaller;
  try {
    $Installer->CheckInstall();
  }
  catch ( CException_Unauthorized $e ) {
    if ( ! headers_sent() )
      header("HTTP/1.1 403 Forbidden");
    echo "You are not authorized as administrator";
    exit;
  }
}

if ( ! $bAdminMode ) {
  require_once "config.php";
  
  if ( ! isset($_REQUEST['Action']) )
    $sErrors = '';
}

if ( isset($_REQUEST['Action']) ) {
  $JsHttpRequest = new JsHttpRequest('UTF-8');
  
  
  $_RequestData = json_decode(file_get_contents('php://input'), true);
  if ( DEBUG ) {
    error_log( $_REQUEST['Action']."\n". var_export($_RequestData, true) ."\n\n",
               3, 'logs/_REQUEST.txt' );
    error_log( var_export($_FILES, true) ."\n", 3, 'logs/_REQUEST.txt' );
    error_log( var_export($_SERVER, true) ."\n", 3, 'logs/_REQUEST.txt' );
    error_log( var_export($_REQUEST, true) ."\n", 3, 'logs/_REQUEST.txt' );
    error_log( "----------\n\n", 3, 'logs/_REQUEST.txt' );
  }
}

if ( ! $bAdminMode ) {
  $DB = new CMySQL(array(
    'Host'     => $config['DB']['Host'],
    'User'     => $config['DB']['User'],
    'Password' => $config['DB']['Password'],
    'DBName'   => $config['DB']['DBName'],
    'Charset'  => 'utf8'
  ));
  unset( $config['DB']['Password'] );
  
  $g_User = null;
  
  if ( isset($_SESSION['Login']) && isset($_SESSION['Password']) )
    $g_User = CUser::Get($_SESSION['Login'], $_SESSION['Password']);
  if ( ! $g_User )
    $g_User = CUser::Get('guest', 'guest');
  
  if ( ! isset($_REQUEST['Action']) ) {
    if ( ! $g_User )
      $sErrors .= 'Ошибка: не найден гостевой аккаунт. Возможно, приложение не установлено.\n';
  }
}

if ( ! isset($_REQUEST['Action']) ) { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>
<?php
  echo (isset($config['SiteTitle']) ?
          $config['SiteTitle'] : CInstaller::$aDefaultConfig['SiteTitle']) .
       ($bAdminMode ? ' - Панель управления' : '') ;
?>
</title>

<style type="text/css">
body { margin: 0; padding: 0; }

body, input, textarea, select {
	font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
	font-size: 13px;
}

a { color: #000060; text-decoration: none; }
a:hover { text-decoration: underline; }
a[disabled=true] { color: Gray; text-decoration: none; cursor: default; }

img { border: none; }

input { margin: 0; border: 1px solid Silver; padding: 2px 4px; }
input[type="checkbox"], input[type="radio"]
  { border: none; margin: 0; padding: 0; vertical-align: middle; }

textarea { margin: 0; }



.Clear { clear: both; }

table.markup { margin: 0; border: none; padding: 0; border-collapse: collapse; }
table.markup > tbody > tr > td { margin: 0; border: none; padding: 0; }

.w100 { width: 100%; }

.BorderBox { box-sizing: border-box;
          -moz-box-sizing: border-box; -ms-box-sizing: border-box; -webkit-box-sizing: border-box; }



.Clickable { cursor: pointer; }

a.Control { cursor: pointer; }

.Disabled { color: Gray; }

img.Icon16 { width: 16px; height: 16px; vertical-align: bottom; }

.ErrorMsgBox { border: 1px solid #A00000; background-color: #FFD0D0; color: #A00000;
               padding: 0.2em; }



#Main { width: 980px; margin: auto; }


.LogInBox { border: 1px solid Silver; background-color: #F0F0F0; }


.PageLink.Number { padding: 2px; }
.PageLink.Dot { padding: 2px 0 2px 0; }
.PageLink.Current { background: #E0E0E0; font-weight: bold; }

.PageNavigationBlock { margin: 0.5em 0; }

textarea[disabled] { background-color: transparent; }



table.Msgs { width: 100%; border-collapse: collapse; }

.Msg.Even { background-color: #FAFAFF; }
.Msg.Odd { background-color: #FFFFFA; }
.Msg { vertical-align: top; }
.Msg > td { border: 1px solid Silver; }

.Msg .UserBox { padding: 0.5em; vertical-align: top; }
.Msg .UserName { font-weight: bold; }
.Msg .UserGroup { font-size: 11px; font-weight: bold; }
.Msg .Admin { color: #FF2020; }

.Msg .MsgBox { width: 100%; padding: 0; }
.Msg .Header { border-bottom: 1px solid #E0E0E0; padding: 3px 5px; font-size: 11px; }
.Msg .Timestamp { color: DimGray; }
.Msg .Text { padding: 0.5em; }

.Msg textarea { border-width: 0 0 1px; border-color: #E0E0E0; }

textarea.MsgEdit { width: 100%; height: 11em; padding: 0.5em;
                   border: 1px solid Silver; }

table.Files td { padding-right: 15px !important; }

.EditButtonsBox { float: right; }



#A_Main { width: 980px; margin: auto; }
.A_ParamSectionHeader { font-weight: bold; }
.A_InstallLog { border: 1px solid Silver; background-color: #F0F0F0; padding: 0.5em; }
</style>

<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>

<script type="text/javascript">
//<![CDATA[

////////////////////////////////////////////////////////////////////////////////////////////////////
// jquery.json-2.2.js

/*
 * jQuery JSON Plugin
 * version: 2.1 (2009-08-14)
 *
 * This document is licensed as free software under the terms of the
 * MIT License: http://www.opensource.org/licenses/mit-license.php
 *
 * Brantley Harris wrote this plugin. It is based somewhat on the JSON.org 
 * website's http://www.json.org/json2.js, which proclaims:
 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.", a sentiment that
 * I uphold.
 *
 * It is also influenced heavily by MochiKit's serializeJSON, which is 
 * copyrighted 2005 by Bob Ippolito.
 */
 
(function($) {
    /** jQuery.toJSON( json-serializble )
        Converts the given argument into a JSON respresentation.

        If an object has a "toJSON" function, that will be used to get the representation.
        Non-integer/string keys are skipped in the object, as are keys that point to a function.

        json-serializble:
            The *thing* to be converted.
     **/
    $.toJSON = function(o)
    {
        if (typeof(JSON) == 'object' && JSON.stringify)
            return JSON.stringify(o);
        
        var type = typeof(o);
    
        if (o === null)
            return "null";
    
        if (type == "undefined")
            return undefined;
        
        if (type == "number" || type == "boolean")
            return o + "";
    
        if (type == "string")
            return $.quoteString(o);
    
        if (type == 'object')
        {
            if (typeof o.toJSON == "function") 
                return $.toJSON( o.toJSON() );
            
            if (o.constructor === Date)
            {
                var month = o.getUTCMonth() + 1;
                if (month < 10) month = '0' + month;

                var day = o.getUTCDate();
                if (day < 10) day = '0' + day;

                var year = o.getUTCFullYear();
                
                var hours = o.getUTCHours();
                if (hours < 10) hours = '0' + hours;
                
                var minutes = o.getUTCMinutes();
                if (minutes < 10) minutes = '0' + minutes;
                
                var seconds = o.getUTCSeconds();
                if (seconds < 10) seconds = '0' + seconds;
                
                var milli = o.getUTCMilliseconds();
                if (milli < 100) milli = '0' + milli;
                if (milli < 10) milli = '0' + milli;

                return '"' + year + '-' + month + '-' + day + 'T' +
                             hours + ':' + minutes + ':' + seconds + 
                             '.' + milli + 'Z"'; 
            }

            if (o.constructor === Array) 
            {
                var ret = [];
                for (var i = 0; i < o.length; i++)
                    ret.push( $.toJSON(o[i]) || "null" );

                return "[" + ret.join(",") + "]";
            }
        
            var pairs = [];
            for (var k in o) {
                var name;
                var type = typeof k;

                if (type == "number")
                    name = '"' + k + '"';
                else if (type == "string")
                    name = $.quoteString(k);
                else
                    continue;  //skip non-string or number keys
            
                if (typeof o[k] == "function") 
                    continue;  //skip pairs where the value is a function.
            
                var val = $.toJSON(o[k]);
            
                pairs.push(name + ":" + val);
            }

            return "{" + pairs.join(", ") + "}";
        }
    };

    /** jQuery.evalJSON(src)
        Evaluates a given piece of json source.
     **/
    $.evalJSON = function(src)
    {
        if (typeof(JSON) == 'object' && JSON.parse)
            return JSON.parse(src);
        return eval("(" + src + ")");
    };
    
    /** jQuery.secureEvalJSON(src)
        Evals JSON in a way that is *more* secure.
    **/
    $.secureEvalJSON = function(src)
    {
        if (typeof(JSON) == 'object' && JSON.parse)
            return JSON.parse(src);
        
        var filtered = src;
        filtered = filtered.replace(/\\["\\\/bfnrtu]/g, '@');
        filtered = filtered.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']');
        filtered = filtered.replace(/(?:^|:|,)(?:\s*\[)+/g, '');
        
        if (/^[\],:{}\s]*$/.test(filtered))
            return eval("(" + src + ")");
        else
            throw new SyntaxError("Error parsing JSON, source is not valid.");
    };

    /** jQuery.quoteString(string)
        Returns a string-repr of a string, escaping quotes intelligently.  
        Mostly a support function for toJSON.
    
        Examples:
            >>> jQuery.quoteString("apple")
            "apple"
        
            >>> jQuery.quoteString('"Where are we going?", she asked.')
            "\"Where are we going?\", she asked."
     **/
    $.quoteString = function(string)
    {
        if (string.match(_escapeable))
        {
            return '"' + string.replace(_escapeable, function (a) 
            {
                var c = _meta[a];
                if (typeof c === 'string') return c;
                c = a.charCodeAt();
                return '\\u00' + Math.floor(c / 16).toString(16) + (c % 16).toString(16);
            }) + '"';
        }
        return '"' + string + '"';
    };
    
    var _escapeable = /["\\\x00-\x1f\x7f-\x9f]/g;
    
    var _meta = {
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"' : '\\"',
        '\\': '\\\\'
    };
})(jQuery);

////////////////////////////////////////////////////////////////////////////////////////////////////

<?php if ( ! $bAdminMode ) { ?>
////////////////////////////////////////////////////////////////////////////////////////////////////
// jquery.fileupload.js

/*
 * jQuery File Upload Plugin 3.8.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

/*jslint browser: true */
/*global File, FileReader, FormData, unescape, jQuery */

(function ($) {

    var defaultNamespace = 'file_upload',
        undef = 'undefined',
        func = 'function',
        num = 'number',
        FileUpload,
        methods,

        MultiLoader = function (callBack, numberComplete) {
            var loaded = 0;
            this.complete = function () {
                loaded += 1;
                if (loaded === numberComplete) {
                    callBack();
                }
            };
        };
        
    FileUpload = function (container) {
        var fileUpload = this,
            uploadForm,
            fileInput,
            settings = {
                namespace: defaultNamespace,
                uploadFormFilter: function (index) {
                    return true;
                },
                fileInputFilter: function (index) {
                    return true;
                },
                cssClass: defaultNamespace,
                dragDropSupport: true,
                dropZone: container,
                url: function (form) {
                    return form.attr('action');
                },
                method: function (form) {
                    return form.attr('method');
                },
                fieldName: function (input) {
                    return input.attr('name');
                },
                formData: function (form) {
                    return form.serializeArray();
                },
                multipart: true,
                multiFileRequest: false,
                withCredentials: false,
                forceIframeUpload: false
            },
            documentListeners = {},
            dropZoneListeners = {},
            protocolRegExp = /^http(s)?:\/\//,
            optionsReference,

            isXHRUploadCapable = function () {
                return typeof XMLHttpRequest !== undef && typeof File !== undef && (
                    !settings.multipart || typeof FormData !== undef || typeof FileReader !== undef
                );
            },

            initEventHandlers = function () {
                if (settings.dragDropSupport) {
                    if (typeof settings.onDocumentDragEnter === func) {
                        documentListeners['dragenter.' + settings.namespace] = function (e) {
                            settings.onDocumentDragEnter(e);
                        };
                    }
                    if (typeof settings.onDocumentDragLeave === func) {
                        documentListeners['dragleave.' + settings.namespace] = function (e) {
                            settings.onDocumentDragLeave(e);
                        };
                    }
                    documentListeners['dragover.'   + settings.namespace] = fileUpload.onDocumentDragOver;
                    documentListeners['drop.'       + settings.namespace] = fileUpload.onDocumentDrop;
                    $(document).bind(documentListeners);
                    if (typeof settings.onDragEnter === func) {
                        dropZoneListeners['dragenter.' + settings.namespace] = function (e) {
                            settings.onDragEnter(e);
                        };
                    }
                    if (typeof settings.onDragLeave === func) {
                        dropZoneListeners['dragleave.' + settings.namespace] = function (e) {
                            settings.onDragLeave(e);
                        };
                    }
                    dropZoneListeners['dragover.'   + settings.namespace] = fileUpload.onDragOver;
                    dropZoneListeners['drop.'       + settings.namespace] = fileUpload.onDrop;
                    settings.dropZone.bind(dropZoneListeners);
                }
                fileInput.bind('change.' + settings.namespace, fileUpload.onChange);
            },

            removeEventHandlers = function () {
                $.each(documentListeners, function (key, value) {
                    $(document).unbind(key, value);
                });
                $.each(dropZoneListeners, function (key, value) {
                    settings.dropZone.unbind(key, value);
                });
                fileInput.unbind('change.' + settings.namespace);
            },

            initUploadEventHandlers = function (files, index, xhr, settings) {
                if (typeof settings.onProgress === func) {
                    xhr.upload.onprogress = function (e) {
                        settings.onProgress(e, files, index, xhr, settings);
                    };
                }
                if (typeof settings.onLoad === func) {
                    xhr.onload = function (e) {
                        settings.onLoad(e, files, index, xhr, settings);
                    };
                }
                if (typeof settings.onAbort === func) {
                    xhr.onabort = function (e) {
                        settings.onAbort(e, files, index, xhr, settings);
                    };
                }
                if (typeof settings.onError === func) {
                    xhr.onerror = function (e) {
                        settings.onError(e, files, index, xhr, settings);
                    };
                }
            },

            getUrl = function (settings) {
                if (typeof settings.url === func) {
                    return settings.url(settings.uploadForm || uploadForm);
                }
                return settings.url;
            },
            
            getMethod = function (settings) {
                if (typeof settings.method === func) {
                    return settings.method(settings.uploadForm || uploadForm);
                }
                return settings.method;
            },
            
            getFieldName = function (settings) {
                if (typeof settings.fieldName === func) {
                    return settings.fieldName(settings.fileInput || fileInput);
                }
                return settings.fieldName;
            },

            getFormData = function (settings) {
                var formData;
                if (typeof settings.formData === func) {
                    return settings.formData(settings.uploadForm || uploadForm);
                } else if ($.isArray(settings.formData)) {
                    return settings.formData;
                } else if (settings.formData) {
                    formData = [];
                    $.each(settings.formData, function (name, value) {
                        formData.push({name: name, value: value});
                    });
                    return formData;
                }
                return [];
            },

            isSameDomain = function (url) {
                if (protocolRegExp.test(url)) {
                    var host = location.host,
                        indexStart = location.protocol.length + 2,
                        index = url.indexOf(host, indexStart),
                        pathIndex = index + host.length;
                    if ((index === indexStart || index === url.indexOf('@', indexStart) + 1) &&
                            (url.length === pathIndex || $.inArray(url.charAt(pathIndex), ['/', '?', '#']) !== -1)) {
                        return true;
                    }
                    return false;
                }
                return true;
            },

            setRequestHeaders = function (xhr, settings, sameDomain) {
                if (sameDomain) {
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                } else if (settings.withCredentials) {
                    xhr.withCredentials = true;
                }
                if ($.isArray(settings.requestHeaders)) {
                    $.each(settings.requestHeaders, function (index, header) {
                        xhr.setRequestHeader(header[0], header[1]);
                    });
                } else if (settings.requestHeaders) {
                    $.each(settings.requestHeaders, function (name, value) {
                        xhr.setRequestHeader(name, value);
                    });
                }
            },

            nonMultipartUpload = function (file, xhr, sameDomain) {
                if (sameDomain) {
                    xhr.setRequestHeader('X-File-Name', unescape(encodeURIComponent(file.name)));
                }
                xhr.setRequestHeader('Content-Type', file.type);
                xhr.send(file);
            },

            formDataUpload = function (files, xhr, settings) {
                var formData = new FormData(),
                    i;
                $.each(getFormData(settings), function (index, field) {
                    formData.append(field.name, field.value);
                });
                for (i = 0; i < files.length; i += 1) {
                    formData.append(getFieldName(settings), files[i]);
                }
                xhr.send(formData);
            },

            loadFileContent = function (file, callBack) {
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    file.content = e.target.result;
                    callBack();
                };
                fileReader.readAsBinaryString(file);
            },

            buildMultiPartFormData = function (boundary, files, filesFieldName, fields) {
                var doubleDash = '--',
                    crlf     = '\r\n',
                    formData = '';
                $.each(fields, function (index, field) {
                    formData += doubleDash + boundary + crlf +
                        'Content-Disposition: form-data; name="' +
                        unescape(encodeURIComponent(field.name)) +
                        '"' + crlf + crlf +
                        unescape(encodeURIComponent(field.value)) + crlf;
                });
                $.each(files, function (index, file) {
                    formData += doubleDash + boundary + crlf +
                        'Content-Disposition: form-data; name="' +
                        unescape(encodeURIComponent(filesFieldName)) +
                        '"; filename="' + unescape(encodeURIComponent(file.name)) + '"' + crlf +
                        'Content-Type: ' + file.type + crlf + crlf +
                        file.content + crlf;
                });
                formData += doubleDash + boundary + doubleDash + crlf;
                return formData;
            },
            
            fileReaderUpload = function (files, xhr, settings) {
                var boundary = '----MultiPartFormBoundary' + (new Date()).getTime(),
                    loader,
                    i;
                xhr.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
                loader = new MultiLoader(function () {
                    xhr.sendAsBinary(buildMultiPartFormData(
                        boundary,
                        files,
                        getFieldName(settings),
                        getFormData(settings)
                    ));
                }, files.length);
                for (i = 0; i < files.length; i += 1) {
                    loadFileContent(files[i], loader.complete);
                }
            },

            upload = function (files, index, xhr, settings) {
                var url = getUrl(settings),
                    sameDomain = isSameDomain(url),
                    filesToUpload;
                initUploadEventHandlers(files, index, xhr, settings);
                xhr.open(getMethod(settings), url, true);
                setRequestHeaders(xhr, settings, sameDomain);
                if (!settings.multipart) {
                    nonMultipartUpload(files[index], xhr, sameDomain);
                } else {
                    if (typeof index === num) {
                        filesToUpload = [files[index]];
                    } else {
                        filesToUpload = files;
                    }
                    if (typeof FormData !== undef) {
                        formDataUpload(filesToUpload, xhr, settings);
                    } else if (typeof FileReader !== undef) {
                        fileReaderUpload(filesToUpload, xhr, settings);
                    } else {
                        $.error('Browser does neither support FormData nor FileReader interface');
                    }
                }
            },

            handleUpload = function (event, files, input, form, index) {
                var xhr = new XMLHttpRequest(),
                    uploadSettings = $.extend({}, settings);
                uploadSettings.fileInput = input;
                uploadSettings.uploadForm = form;
                if (typeof uploadSettings.initUpload === func) {
                    uploadSettings.initUpload(
                        event,
                        files,
                        index,
                        xhr,
                        uploadSettings,
                        function () {
                            upload(files, index, xhr, uploadSettings);
                        }
                    );
                } else {
                    upload(files, index, xhr, uploadSettings);
                }
            },

            handleFiles = function (event, files, input, form) {
                var i;
                if (settings.multiFileRequest) {
                    handleUpload(event, files, input, form);
                } else {
                    for (i = 0; i < files.length; i += 1) {
                        handleUpload(event, files, input, form, i);
                    }
                }
            },

            legacyUploadFormDataInit = function (input, form, settings) {
                var formData = getFormData(settings);
                form.find(':input').not(':disabled')
                    .attr('disabled', true)
                    .addClass(settings.namespace + '_disabled');
                $.each(formData, function (index, field) {
                    $('<input type="hidden"/>')
                        .attr('name', field.name)
                        .val(field.value)
                        .addClass(settings.namespace + '_form_data')
                        .appendTo(form);
                });
                input
                    .attr('name', getFieldName(settings))
                    .appendTo(form);
            },

            legacyUploadFormDataReset = function (input, form, settings) {
                input.detach();
                form.find('.' + settings.namespace + '_disabled')
                    .removeAttr('disabled')
                    .removeClass(settings.namespace + '_disabled');
                form.find('.' + settings.namespace + '_form_data').remove();
            },

            legacyUpload = function (input, form, iframe, settings) {
                var originalAction = form.attr('action'),
                    originalMethod = form.attr('method'),
                    originalTarget = form.attr('target');
                iframe
                    .unbind('abort')
                    .bind('abort', function (e) {
                        iframe.readyState = 0;
                        // javascript:false as iframe src prevents warning popups on HTTPS in IE6
                        // concat is used here to prevent the "Script URL" JSLint error:
                        iframe.unbind('load').attr('src', 'javascript'.concat(':false;'));
                        if (typeof settings.onAbort === func) {
                            settings.onAbort(e, [{name: input.val(), type: null, size: null}], 0, iframe, settings);
                        }
                    })
                    .unbind('load')
                    .bind('load', function (e) {
                        iframe.readyState = 4;
                        if (typeof settings.onLoad === func) {
                            settings.onLoad(e, [{name: input.val(), type: null, size: null}], 0, iframe, settings);
                        }
                        // Fix for IE endless progress bar activity bug (happens on form submits to iframe targets):
                        $('<iframe src="javascript:false;" style="display:none"></iframe>').appendTo(form).remove();
                    });
                form
                    .attr('action', getUrl(settings))
                    .attr('method', getMethod(settings))
                    .attr('target', iframe.attr('name'));
                legacyUploadFormDataInit(input, form, settings);
                iframe.readyState = 2;
                form.get(0).submit();
                legacyUploadFormDataReset(input, form, settings);
                form
                    .attr('action', originalAction)
                    .attr('method', originalMethod)
                    .attr('target', originalTarget);
            },

            handleLegacyUpload = function (event, input, form) {
                // javascript:false as iframe src prevents warning popups on HTTPS in IE6:
                var iframe = $('<iframe src="javascript:false;" style="display:none" name="iframe_' +
                    settings.namespace + '_' + (new Date()).getTime() + '"></iframe>'),
                    uploadSettings = $.extend({}, settings);
                uploadSettings.fileInput = input;
                uploadSettings.uploadForm = form;
                iframe.readyState = 0;
                iframe.abort = function () {
                    iframe.trigger('abort');
                };
                iframe.bind('load', function () {
                    iframe.unbind('load');
                    if (typeof uploadSettings.initUpload === func) {
                        uploadSettings.initUpload(
                            event,
                            [{name: input.val(), type: null, size: null}],
                            0,
                            iframe,
                            uploadSettings,
                            function () {
                                legacyUpload(input, form, iframe, uploadSettings);
                            }
                        );
                    } else {
                        legacyUpload(input, form, iframe, uploadSettings);
                    }
                }).appendTo(form);
            },
            
            initUploadForm = function () {
                uploadForm = (container.is('form') ? container : container.find('form'))
                    .filter(settings.uploadFormFilter);
            },
            
            initFileInput = function () {
                fileInput = uploadForm.find('input:file')
                    .filter(settings.fileInputFilter);
            },
            
            replaceFileInput = function (input) {
                var inputClone = input.clone(true);
                $('<form/>').append(inputClone).get(0).reset();
                input.after(inputClone).detach();
                initFileInput();
            };

        this.onDocumentDragOver = function (e) {
            if (typeof settings.onDocumentDragOver === func &&
                    settings.onDocumentDragOver(e) === false) {
                return false;
            }
            e.preventDefault();
        };
        
        this.onDocumentDrop = function (e) {
            if (typeof settings.onDocumentDrop === func &&
                    settings.onDocumentDrop(e) === false) {
                return false;
            }
            e.preventDefault();
        };

        this.onDragOver = function (e) {
            if (typeof settings.onDragOver === func &&
                    settings.onDragOver(e) === false) {
                return false;
            }
            var dataTransfer = e.originalEvent.dataTransfer;
            if (dataTransfer && dataTransfer.files) {
                dataTransfer.dropEffect = dataTransfer.effectAllowed = 'copy';
                e.preventDefault();
            }
        };

        this.onDrop = function (e) {
            if (typeof settings.onDrop === func &&
                    settings.onDrop(e) === false) {
                return false;
            }
            var dataTransfer = e.originalEvent.dataTransfer;
            if (dataTransfer && dataTransfer.files && isXHRUploadCapable()) {
                handleFiles(e, dataTransfer.files);
            }
            e.preventDefault();
        };
        
        this.onChange = function (e) {
            if (typeof settings.onChange === func &&
                    settings.onChange(e) === false) {
                return false;
            }
            var input = $(e.target),
                form = $(e.target.form);
            if (form.length === 1) {
                input.data(defaultNamespace + '_form', form);
                replaceFileInput(input);
            } else {
                form = input.data(defaultNamespace + '_form');
            }
            if (!settings.forceIframeUpload && e.target.files && isXHRUploadCapable()) {
                handleFiles(e, e.target.files, input, form);
            } else {
                handleLegacyUpload(e, input, form);
            }
        };

        this.init = function (options) {
            if (options) {
                $.extend(settings, options);
                optionsReference = options;
            }
            initUploadForm();
            initFileInput();
            if (container.data(settings.namespace)) {
                $.error('FileUpload with namespace "' + settings.namespace + '" already assigned to this element');
                return;
            }
            container
                .data(settings.namespace, fileUpload)
                .addClass(settings.cssClass);
            settings.dropZone.not(container).addClass(settings.cssClass);
            initEventHandlers();
        };

        this.options = function (options) {
            var oldCssClass,
                oldDropZone,
                uploadFormFilterUpdate,
                fileInputFilterUpdate;
            if (typeof options === undef) {
                return $.extend({}, settings);
            }
            if (optionsReference) {
                $.extend(optionsReference, options);
            }
            removeEventHandlers();
            $.each(options, function (name, value) {
                switch (name) {
                case 'namespace':
                    $.error('The FileUpload namespace cannot be updated.');
                    return;
                case 'uploadFormFilter':
                    uploadFormFilterUpdate = true;
                    fileInputFilterUpdate = true;
                    break;
                case 'fileInputFilter':
                    fileInputFilterUpdate = true;
                    break;
                case 'cssClass':
                    oldCssClass = settings.cssClass;
                    break;
                case 'dropZone':
                    oldDropZone = settings.dropZone;
                    break;
                }
                settings[name] = value;
            });
            if (uploadFormFilterUpdate) {
                initUploadForm();
            }
            if (fileInputFilterUpdate) {
                initFileInput();
            }
            if (typeof oldCssClass !== undef) {
                container
                    .removeClass(oldCssClass)
                    .addClass(settings.cssClass);
                (oldDropZone ? oldDropZone : settings.dropZone).not(container)
                    .removeClass(oldCssClass);
                settings.dropZone.not(container).addClass(settings.cssClass);
            } else if (oldDropZone) {
                oldDropZone.not(container).removeClass(settings.cssClass);
                settings.dropZone.not(container).addClass(settings.cssClass);
            }
            initEventHandlers();
        };
        
        this.option = function (name, value) {
            var options;
            if (typeof value === undef) {
                return settings[name];
            }
            options = {};
            options[name] = value;
            fileUpload.options(options);
        };
        
        this.destroy = function () {
            removeEventHandlers();
            container
                .removeData(settings.namespace)
                .removeClass(settings.cssClass);
            settings.dropZone.not(container).removeClass(settings.cssClass);
        };
    };

    methods = {
        init : function (options) {
            return this.each(function () {
                (new FileUpload($(this))).init(options);
            });
        },
        
        option: function (option, value, namespace) {
            namespace = namespace ? namespace : defaultNamespace;
            var fileUpload = $(this).data(namespace);
            if (fileUpload) {
                if (typeof option === 'string') {
                    return fileUpload.option(option, value);
                }
                return fileUpload.options(option);
            } else {
                $.error('No FileUpload with namespace "' + namespace + '" assigned to this element');
            }
        },
                
        destroy : function (namespace) {
            namespace = namespace ? namespace : defaultNamespace;
            return this.each(function () {
                var fileUpload = $(this).data(namespace);
                if (fileUpload) {
                    fileUpload.destroy();
                } else {
                    $.error('No FileUpload with namespace "' + namespace + '" assigned to this element');
                }
            });

        }
    };
    
    $.fn.fileUpload = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.fileUpload');
        }
    };
    
}(jQuery));

<?php } ?>

////////////////////////////////////////////////////////////////////////////////////////////////////

  var C_sBackEnd = 'guestbook.php';
  
  var C_sPacketQueryContextValue = '<?php echo C_sPacketQueryContextValue; ?>';
  
  var C_GeneralTimeout =
    <?php echo (isset($config['GeneralTimeout']) ? $config['GeneralTimeout'] : 30) * 1000; ?>;
  
  var C_sImagesPrefix = C_sBackEnd+'?img=';
  
<?php if ( $bAdminMode ) { ?>
  var C_sTemplate_A_Install = "<?php echo CString::EscapeForScript(<<<EOT
<h2 style='text-align:center'>Установка</h2>

<div class='A_ParamSectionHeader'>Параметры подключения к БД</div>
<table>
  <tr><td>Хост</td><td><input id='%IDP%DB_Host' size='50' /></td></tr>
  <tr><td>Логин</td><td><input id='%IDP%DB_User' size='50' /></td></tr>
  <tr><td>Пароль</td><td><input id='%IDP%DB_Password' size='50' /></td></tr>
  <tr><td>Имя БД</td><td><input id='%IDP%DB_DBName' size='50' /></td></tr>
</table>
<br />
<div class='A_ParamSectionHeader'>Аккаунт администратора гостевой книги</div>
<table>
  <tr>
    <td>Логин</td>
    <td>
      <input id='%IDP%AdminLogin' size='50' />
        До 30 символов; только латинские буквы, цифры и '_'
      <div id='%IDP%AdminLoginMsgBox' class='ErrorMsgBox' style='display:none'>
        <div id='%IDP%AdminLoginMsg' class='ErrorMsg'></div>
      </div>
    </td>
  </tr>
  <tr>
    <td>Пароль</td>
    <td>
      <input id='%IDP%AdminPassword' type='password' size='25' />
        повтор <input id='%IDP%AdminPassword2' type='password' size='25' />
        5-16 символов; только латинские буквы, цифры и '_'</td></tr>
      <div id='%IDP%AdminPasswordMsgBox' class='ErrorMsgBox' style='display:none'>
        <div id='%IDP%AdminPasswordMsg' class='ErrorMsg'></div>
      </div>
    </td>
  </tr>
</table>
<br />
- Параметры будут сохранены в файл config.php в корневой директории приложения.<br />
- Загружаемые файлы изображений сохраняются в files/.<br />
- Логи в отладочном режиме (define('DEBUG', true);) сохраняются в logs/.<br />
PHP должен иметь права записи в эти директории.<br />
<br />
<button type='button' id='%IDP%InstallBtn'>
  Установить
  <img id='%IDP%InstallWait' src='%ImagesPrefix%wait.gif'
       class='Icon16' style='display:none'>
</button>

<div id='%IDP%InstallLog' class='A_InstallLog' style='display:none'></div>

<div id='%IDP%InstallMsgBox' class='ErrorMsgBox' style='display:none'>
  <div id='%IDP%InstallMsg' class='ErrorMsg'></div>
</div>

<br />
<a id='%IDP%GoToConfigTrigger' class='Clickable' style='display:none'>Конфигурация</a>
EOT
  ); ?>";
  
  var C_sTemplate_A_Config = "<?php echo CString::EscapeForScript(<<<EOT
<h2 style='text-align:center'>Конфигурация</h2>

Параметры хранятся в файле config.php.<br />
<br />
<div class='A_ParamSectionHeader'>Вид</div>
<table>
  <tr><td>Заголовок окна</td><td><input id='%IDP%SiteTitle' size='100' /></td></tr>
  <tr><td>Число сообщений на странице</td><td><input id='%IDP%NumMsgsOnPage' size='5' /></td></tr>
  <!--<tr>-->
  <!--  <td>Шаблон оформления</td>-->
  <!--  <td><input id='%IDP%Template' size='30' /> Шаблоны находятся в директории templates</td>-->
  <!--</tr>-->
  <tr><td>Кодировка файловой системы</td>
      <td><input id='%IDP%FileSystemEncoding' size='10' /></td></tr>
</table>
<br />
<button type='button' id='%IDP%ApplyBtn'>
  Применить
  <img id='%IDP%ApplyWait' src='%ImagesPrefix%wait.gif' class='Icon16' style='display:none'>
</button>

<div id='%IDP%ApplyMsgBox' class='ErrorMsgBox' style='display:none'>
  <div id='%IDP%ApplyMsg' class='ErrorMsg'></div>
</div>
EOT
  ); ?>";
  
<?php } else { ?>
  var C_sTemplate_Main = "<?php echo CString::EscapeForScript(<<<EOT
<br />

<div>
  <div style='position:relative'>
    <img src='%ImagesPrefix%logo_softline.png' style='position:absolute' />
  </div>
  <div style='text-align:center'>
    <div style='font-size:2em; font-weight:bold;'>Гостевая книга</div>
    <div>Хованский А. О.</div>
  </div>
</div>

<div id='UserBlock_Guest' style='display:none'>
  <div><a id='ToggleLogInPaneTrigger' class='Clickable'>Вход</a> &sdot;
       <a id='ToggleRegisterPaneTrigger' class='Clickable'>Регистрация</a></div>
  
  <div style='position:relative'>
    <div id='LogInBox' class='LogInBox' style='position:absolute; display:none'>
      Логин <input id='LogIn_Login' size='30' />
      Пароль <input id='LogIn_Password' type='password' size='20' />
      <button type='button' id='LogInBtn'>
        Вход
        <img id='LogInWait' src='%ImagesPrefix%wait.gif' class='Icon16' style='display:none'>
      </button>
      <div id='LogInMsgBox' class='ErrorMsgBox' style='display:none'>
        <div id='LogInMsg' class='ErrorMsg'></div>
      </div>
    </div>
    
    <div id='Register' style='position:absolute'></div>
  </div>
</div>
<div id='UserBlock_User' style='display:none'>
  Здравствуйте, <span id='Login'></span> &sdot; <a id='LogOutTrigger' class='Clickable'>Выход</a>
  <span id='UserBlock_Admin' style='display:none'>
    | <a href='?admin=1' target='_blank'>Панель управления</a>
  </span>
</div>

<hr />

<div>
  <div id='MsgsMsgBox' class='ErrorMsgBox' style='display:none'>
    <div id='MsgsMsg' class='ErrorMsg'></div>
  </div>
  <div id='MsgsView'>
    <div id='MsgsNavTop' class='PageNavigationBlock'></div>
    <div id='MsgsList'></div>
    <div id='MsgsNavBottom' class='PageNavigationBlock'></div>
  </div>
  
  <br />
  
  <div id='PostBlock_Guest' style='display:none'>
    Только зарегистрированные пользователи могут оставлять сообщения
  </div>
  <div id='PostBlock_User' style='display:none'>
    <div style='font-weight:bold; text-align: center'>Ваше сообщение:</div>
    
    <div id='MsgEdit'></div>
  </div>
</div>

<br />
<hr />
<div style='font-size:11px; text-align: right'>Хованский А. О.</div>
<br />
EOT
  ); ?>";
  
  var C_sTemplate_Register = "<?php echo CString::EscapeForScript(<<<EOT
<div class='LogInBox'>
  <table>
    <tr>
      <td>Логин</td>
      <td>
        <input id='%IDP%Login' size='50' />
          До 30 символов; только латинские буквы, цифры и '_'
        <div id='%IDP%LoginMsgBox' class='ErrorMsgBox' style='display:none'>
          <div id='%IDP%LoginMsg' class='ErrorMsg'></div>
        </div>
      </td>
    </tr>
    <tr>
      <td>Пароль</td>
      <td>
        <input id='%IDP%Password' type='password' size='25' />
          повтор <input id='%IDP%Password2' type='password' size='25' />
          5-16 символов; только латинские буквы, цифры и '_'</td></tr>
        <div id='%IDP%PasswordMsgBox' class='ErrorMsgBox' style='display:none'>
          <div id='%IDP%PasswordMsg' class='ErrorMsg'></div>
        </div>
      </td>
    </tr>
  </table>
  <button type='button' id='%IDP%RegisterBtn'>
    Регистрация
    <img id='%IDP%Wait' src='%ImagesPrefix%wait.gif' class='Icon16' style='display:none'>
  </button>
  <div id='%IDP%MsgBox' class='ErrorMsgBox' style='display:none'>
    <div id='%IDP%Msg' class='ErrorMsg'></div>
  </div>
</div>
EOT
  ); ?>";
  
  var C_sTemplate_Msg = "<?php echo CString::EscapeForScript(<<<EOT
<td class='UserBox'>
  <div id='Msg%ID%UserLogin' class='UserName'></div>
  <div id='Msg%ID%UserGroup' class='UserGroup' style='display:none'></div>
</td>
<td id='Msg%ID%MsgBox' class='MsgBox'>
  <div class='Header'>
    <span id='Msg%ID%CreateTimestamp' class='Timestamp'></span>
    
    <span id='Msg%ID%Controls' style='float:right'></span>
  </div>
  <div id='Msg%ID%TextContainer'>
    <div id='Msg%ID%Text' class='Text'></div>
    <div id='Msg%ID%Edit' style='display:none'></div>
  </div>
</td>
EOT
  ); ?>";
  
  var C_sTemplate_MsgEdit = "<?php echo CString::EscapeForScript(<<<EOT
<textarea id='%IDP%Textarea' class='MsgEdit BorderBox'></textarea>

Загрузить изображение:
<form id='%IDP%FilesForm' enctype='multipart/form-data'>
  <input type='file' name='file'>
</form>

<table id='%IDP%Files' class='markup Files'></table>

<div class='EditButtonsBox'>
  <button id='%IDP%SendTrigger'>
    Отправить
    <span id='%IDP%ChangeIndicator' style='display:none'>*</span>
    <img id='%IDP%SendWait' src='%ImagesPrefix%wait.gif'
         class='Icon16' style='display:none'>
  </button>
  <button id='%IDP%CancelTrigger' style='display:none'>Отменить</button>
</div>
<div class='Clear'></div>

<div id='%IDP%MsgBox' class='ErrorMsgBox' style='display:none'>
  <div id='%IDP%Msg' class='ErrorMsg'></div>
</div>
EOT
  ); ?>";
  
  var C_sTemplate_File = "<?php echo CString::EscapeForScript(<<<EOT
<td id='%IDP%Name'></td>
<td id='%IDP%Size'></td>
<td>
  <img id='%IDP%Wait' src='%ImagesPrefix%wait.gif' class='Icon16' style='display:none'>
  <a id='%IDP%InsertTrigger' class='Clickable' style='display:none'>Вставить</a>
  <div id='%IDP%MsgBox' class='ErrorMsgBox' style='display:none'>
    <div id='%IDP%Msg' class='ErrorMsg'></div>
  </div>
</td>
EOT
  ); ?>";
  
  var g_sUserLogin = '<?php echo $g_User ? $g_User->Login : ''; ?>';
  var g_iUserGroup = <?php echo $g_User ? $g_User->Group : -1; ?>;
  
  // As in User.php
  var UserGroup_Guest = 0;
  var UserGroup_User = 1;
  var UserGroup_Admin = 2;

  var C_iNumMsgsOnPage =
    <?php echo isset($config['NumMsgsOnPage']) ?
               $config['NumMsgsOnPage'] : CInstaller::$aDefaultConfig['NumMsgsOnPage']; ?>;

  var sInitErrors = '<?php echo $sErrors; ?>';
<?php } ?>

////////////////////////////////////////////////////////////////////////////////////////////////////
// jsx.js

var jsx = {};


jsx.rNewLines = /\r\n|\r|\n/g;


//

String.prototype.HtmlEncode = function() {
  return this.replace(/&/g, '&amp;').replace(/\"/g, '&quot;')
             .replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

String.prototype.NewLinesToHtml = function() {
  return this.replace(/\r\n|\r|\n/g, '<br>');
}

String.prototype.Html = function() {
  return this.HtmlEncode().NewLinesToHtml();
}


////////////////////////////////////////////////////////////////////////////////////////////////////

Array.prototype.Contains = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v )
      return true;
  return false;
}

Array.prototype.Delete = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v ) {
      this.splice(i, 1);
      break;
    }
  return this;
}

Array.prototype.Find_V = function( _v ) {
  for ( var i = 0; i < this.length; i++ )
    if ( typeof(_v) == 'function' ? _v(this[i]) : (this[i] == _v) )
      return this[i];
  return null;
}

//

Array.prototype.Set_Add_R = function( _v ) {
  if ( this.Contains(_v) )
    return false;
  
  this.push(_v);
  return true;
}

Array.prototype.Set_Delete_R = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v ) {
      this.splice(i, 1);
      return true;
    }
  return false;
}

Array.prototype.Set_Subtract = function( _v ) {
  if ( _v instanceof Array ) {
    for ( var i = 0; i < _v.length; ++i )
      this.Delete(_v[i]);
  }
  else
    this.Delete(_v);
  
  return this;
}

Array.prototype.Set_Extract = function( _a ) {
  var a = [];
  
  for ( var i = 0; i < this.length; )
    if ( _a.Contains(this[i]) ) {
      a.push(this[i]);
      this.splice(i, 1);
    }
    else
      i++
  
  return a;
}

//

jsx.Object = {
  IsEmpty: function( _o ) {
    for ( var k in _o )
      return false;
    return true;
  },
  
  
  HasAnyKey: function( _o, _aKeys ) {
    for ( var i = 0; i < _aKeys.length; i++ )
      if ( _o[_aKeys[i]] !== undefined )
        return true;
    return false;
  },
  
  
  Clone: function( _o ) {
    var o = {};
    for ( var k in _o )
      o[k] = _o[k];
    return o;
  },
  
  
  Extract: function( _o, _aProps ) {
    var o = {};
    for ( var i = 0, sProp; sProp = _aProps[i]; i++ )
      if ( _o[sProp] !== undefined ) {
        o[sProp] = _o[sProp];
        delete _o[sProp];
      }
    
    return o;
  },
  
  
  Select: function( _o, _Props ) {
    var o = {};
    
    var aInclude = _Props instanceof Array ? _Props : null;
    var aExclude = _Props instanceof Array ? null : _Props.Exclude;
    
    for ( var k in _o )
      if ( aInclude && aInclude.Contains(k) ||
           aExclude && ! aExclude.Contains(k) )
        o[k] = _o[k];
    
    return o;
  },
  
  
  Flip_A: function( _o ) {
    var o = {}, v, a;
    for ( var k in _o ) {
      v = _o[k];
      if ( ! (a = o[v]) )
        a = o[v] = [];
      a.push(k);
    }
    return o;
  },
  
  
  All_M: function( _o, _fn ) {
    for ( var k in _o )
      if ( ! _fn.call(_o[k]) )
        return false;
    return true;
  }
}

//

jsx.Equal = function( _1, _2 ) {
  if ( _1 === _2)
    return true;
  else if ( _1 instanceof Array && _2 instanceof Array ) {
    if ( _1.length != _2.length )
      return false;
    for ( var i = 0; i < _1.length; ++i )
      if ( ! jsx.Equal(_1[i], _2[i]) )
        return false;
    return true;
  }
  else if ( _1 === null && _2 === null ) // typeof(null) == 'object'
    return true;
  else if ( typeof(_1) == 'object' && typeof(_2) == 'object' ) {
    var Keys = {};
    for ( var Key in _1 ) {
      if ( ! jsx.Equal(_1[Key], _2[Key]) )
        return false;
      Keys[Key] = true;
    }
    for ( var Key in _2 )
      if ( ! Keys[Key] && ! jsx.Equal(_1[Key], _2[Key]) )
        return false;
    return true;
  }
  else
    return false;
}

jsx.CompareNumbers = function( _1, _2 ) {
  return _1 - _2;
}

////////////////////////////////////////////////////////////////////////////////////////////////////


jsx.Extend = function( _Child, _Super ) {
  for ( var Property in _Super.prototype ) {
    if (typeof _Child.prototype[Property] == "undefined")
      _Child.prototype[Property] = _Super.prototype[Property];
  }
  return _Child;
}


//

jsx.Flags = function( _v ) {
  this.o = _v || {};
}
jsx.Flags.prototype = {
  IsSet_Any: function( _v ) {
    if ( _v instanceof Array ) {
      for ( var i = 0; i < _v.length; i++ )
        if ( this.o[_v[i]] )
          return true;
      return false;
    }
    else
      return Boolean(this.o[_v]);
  }
}

//

jsx.CCallback = function( _FnOrArr ) {
  this.a = typeof(_FnOrArr) == 'function' ? [null, _FnOrArr] : _FnOrArr;
}
jsx.CCallback.prototype = {
  Obj: function() {
    return this.a[0];
  },
  
  Call: function() {
    // IE (8) can't handle undefined or null for Args
    return this.a[1].apply(this.a[0], arguments.length ? arguments : (this.Args || []));
  }
}


jsx.Call = function( _CallObj ) {
  if ( typeof(_CallObj) == 'function' ) {
    var Obj = null;
    var fn = _CallObj;
  }
  else {
    var Obj = _CallObj[0];
    var fn = _CallObj[1];
  }
  
  fn.apply(Obj, Array.prototype.slice.call(arguments, 1));
}


jsx.Call_A = function( _CallObj, _aArgs ) {
  if ( typeof(_CallObj) == 'function' ) {
    var Obj = null;
    var fn = _CallObj;
  }
  else {
    var Obj = _CallObj[0];
    var fn = _CallObj[1];
  }
  
  fn.apply(Obj, _aArgs);
}

//

jsx.CObjectRepository = function() {
  this.Data = {};
}

jsx.CObjectRepository.prototype = {
  Get: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      Class = this.Data[_sClass] = {};
    
    if ( typeof(_ID) == 'object' && ! (_ID instanceof Number) && ! (_ID instanceof String) ) {
      for ( var ID in _ID )
        _ID[ID] = this._Get(Class, _sClass, ID, _ID[ID]);
      return _ID;
    }
    else
      return this._Get(Class, _sClass, _ID);
  },
  
  
  GetObjects: function( _Classes_Objs ) {
    for ( var sClass in _Classes_Objs )
      this.Get(sClass, _Classes_Objs[sClass]);
    return _Classes_Objs;
  },
  
  
  GetExisting: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      return null;
    
    var ObjData = Class[_ID];
    if ( ! ObjData )
      return null;
    
    ObjData.RefCount++;
    return ObjData.Obj;
  },
  
  
  GetWeak: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      return null;
    
    var ObjData = Class[_ID];
    if ( ! ObjData )
      return null;
    
    return ObjData.Obj;
  },
  
  
  Release: function() {
    if ( arguments.length == 1 ) {
      var _ID = arguments[0];
      
      if ( _ID instanceof Array )
        for ( var i = 0; i < _ID.length; i++ )
          this.Release(_ID[i]);
      else {
        var _Obj = arguments[0];
        
        if ( _Obj == null )
          return null;
        
        return this._Release(this.Data[_Obj.sClass], _Obj.ID);
      }
    }
    else {
      var Class = this.Data[arguments[0]];
      var _ID = arguments[1];
      var RefCount = arguments[2];
      
      if ( _ID instanceof Array )
        for ( var i = 0; i < _ID.length; i++ )
          this._Release(Class, _ID[i]);
      else if ( typeof(_ID) == 'object' && ! (_ID instanceof Number) && ! (_ID instanceof String) )
        for ( var ID in _ID )
          this._Release(Class, ID, _ID[ID]);
      else
        return this._Release(Class, _ID, RefCount);
    }
    
    return null; // dummy for multi-obj cases
  },
  
  
  ReleaseObjects: function( _Classes_Objs ) {
    for ( var sClass in _Classes_Objs )
      this.Release(sClass, _Classes_Objs[sClass]);
  },
  
  
  _Get: function( _Class, _sClass, _ID, _RefCount ) {
    if ( _RefCount === undefined )
      _RefCount = 1;
    
    var ObjData = _Class[_ID];
    if ( ObjData ) {
      ObjData.RefCount += _RefCount;
      return ObjData.Obj;
    }
    else {
      var Obj = eval('new C'+_sClass);
      Obj.ID = _ID;
      
      if ( Obj.Init )
        Obj.Init();
      
      _Class[_ID] = {'Obj': Obj, RefCount: _RefCount}
      return Obj;
    }
  },
  
  
  _Release: function( _Class, _ID, _RefCount ) {
    if ( _RefCount === undefined )
      _RefCount = 1;
    
    var ObjData = _Class[_ID];
        if(DBG) jsx.Console.Assert(ObjData, '_ID = ',_ID);
    
    ObjData.RefCount -= _RefCount;
    if ( ObjData.RefCount < 0 )
      jsx.Console.Error('ObjData.RefCount < 0', ObjData);
    
    if ( ObjData.RefCount <= 0 ) {
      ObjData.Obj.Destruct();
      delete _Class[_ID];
      return 0;
    }
    else
      return ObjData.RefCount;
  },
  
  
  _PrintDebugInfo: function() {
    for ( var sClass in this.Data ) {
      var Class = this.Data[sClass];
      
      var i = 0;
      var aIDs = [];
      for ( var ID in Class ) {
        i++;
        aIDs.push(ID+':'+Class[ID].RefCount);
      }
      
      jsx.Console.Log(sClass+': '+i+': '+aIDs.join(', '));
    }
  }
}

jsx.ObjectRepository = new jsx.CObjectRepository;

//

jsx.CObject = function() {
}
jsx.CObject.prototype = {
  Destruct: function() {
  },
  
  
  AddRef: function() {
    jsx.ObjectRepository.Get(this.sClass, this.ID);
  },
  
  ReleaseRef: function() {
    jsx.ObjectRepository.Release(this.sClass, this.ID);
  }
}

//

jsx.Destruct = function( _Obj ) {
  if ( _Obj && _Obj.Destruct )
    _Obj.Destruct();
}


//

jsx.CModel = function() {
  this.aViews = [];
}

jsx.CModel.prototype = {
  AddView: function( _View ) {
jsx.Console.GroupCollapsed('CModel['+this.sClass+':'+this.ID+'].AddView');
    
    this.aViews.push( _View );
    _View.Attach(this);
    
jsx.Console.GroupEnd();
  },
  
  DetachView: function( _View ) {
    this.aViews.Delete(_View);
  },
  
  InvalidateViews: function( _Hints ) {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].InvalidateViews');
if ( _Hints )
  jsx.Console.Dir(_Hints);
    
    for ( var i = 0, View; View = this.aViews[i]; ++i )
      View.Invalidate(_Hints);
    
jsx.Console.GroupEnd();
  },
  
  
  UpdateViews: function() {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].UpdateViews');
    
    for ( var i = 0, View; View = this.aViews[i]; ++i )
      View.Update();
    
jsx.Console.GroupEnd();
  },
  
  
  UpdateData: function( _Data ) {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].UpdateData');
    
    var Changed = {};
    
    for ( var Key in _Data ) {
      if ( ! jsx.Equal(_Data[Key], this.Data[Key]) ) {
        this.Data[Key] = _Data[Key];
        Changed[Key] = true;
      }
    }
    
    if ( ! jsx.Object.IsEmpty(Changed) )
      this.InvalidateViews({Data: Changed});
    
jsx.Console.GroupEnd();
  },
  
  
  ViewsUseField: function( _sField ) {
    for ( var i = 0, View; View = this.aViews[i]; i++ )
      if ( View.aUsedFields && View.aUsedFields.Contains(_sField) )
        return true;
    return false;
  }
}
jsx.Extend(jsx.CModel, jsx.CObject);

//

jsx.CView = function() {
  this.Model = null;
  
  this.bDirty = true;
  this.UpdateHints = {};
  this.bUpdateHintsTracking = false;
  
  this.Parent = null;
  
  this.aChildren = [];
  this.bDescendantsDirty = false;
}

jsx.CView.prototype = {
  Attach: function( _Model ) {
  jsx.Console.Group('CView['+_Model.sClass+':'+_Model.ID+' #'+this.DID+'].Attach');
  this.DebugPrint();
    
    this.Model = _Model;
    this.Invalidate();
    this.bUpdateHintsTracking = false;
    
    if ( this.OnModelAttach )
      this.OnModelAttach();
    
  jsx.Console.GroupEnd();
  },
  
  
  Detach: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Detach');
  this.DebugPrint();
    
    if ( this.Model ) {
      this.Model.DetachView(this);
      this.Model = null;
    }
    
  jsx.Console.GroupEnd();
  },
  
  
  // _Hint can be string or array
  Invalidate: function( _Hints ) {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Invalidate');
  this.DebugPrint();
    
    if ( ! _Hints )
      _Hints = {all: true};
    
    jQuery.extend(true, this.UpdateHints, _Hints);
    
    if ( this.Parent )
      if ( ! (this.bDirty || this.bDescendantsDirty) )
        this.Parent.SetDescendantsDirty();
    
    this.bDirty = true;
    
  jsx.Console.GroupEnd();
  },
  
  
  AddChild: function( _Child ) {
        jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].AddChild');
        this.DebugPrint();
    
    _Child.Parent = this;
    this.aChildren.push(_Child);
    
    if ( _Child.bDirty || _Child.bDescendantsDirty )
      this.SetDescendantsDirty();
    
        jsx.Console.GroupEnd();
  },
  
  
  SetDescendantsDirty: function() {
  jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].SetDescendantsDirty');
  this.DebugPrint();
    
    if ( this.Parent )
      if ( ! (this.bDirty || this.bDescendantsDirty) )
        this.Parent.SetDescendantsDirty();
    
    this.bDescendantsDirty = true;
    
  jsx.Console.GroupEnd();
  },
  
  
  Update: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Update');
  this.DebugPrint();
    
    if ( this.bDirty ) {
      if ( ! this.Update_(this.UpdateHints) ) {
        jsx.Console.Log('return false');
        jsx.Console.GroupEnd();
        return false;
      }
      
      this.bDirty = false;
      this.UpdateHints = {};
    }
    
    var b = this.bDescendantsDirty && this.aChildren.length ? this._UpdateChildren() : true;
    
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  UpdateChildren: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].UpdateChildren');
  this.DebugPrint();
    
    var b = this.bDescendantsDirty && this.aChildren.length ? this._UpdateChildren() : true;
      
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  _UpdateChildren: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+']._UpdateChildren');
  this.DebugPrint();
    
    var b = true;
    
    for ( var i = 0, View; View = this.aChildren[i]; i++ )
      if ( ! View.Update() )
        b = false;
    
    if ( b )
      this.bDescendantsDirty = false;
      
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  DeleteChildren: function( _a ) {
        jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].DeleteChildren');
        this.DebugPrint();
    
    if ( _a )
      for ( var i = 0; i < _a.length; i++ )
        this.DeleteChild(_a[i]);
    else {
      for ( var i = 0, View; View = this.aChildren[i]; i++ )
        View.Destruct();
      
      this.ClearChildren();
    }
    
        jsx.Console.GroupEnd();
  },
  
  
  DeleteChild: function( _View ) {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].DeleteChild');
        this.DebugPrint();
    
    if ( this.aChildren.Set_Delete_R(_View) ) {
      _View.Destruct();
      
      if ( ! this.aChildren.length )
        this.bDescendantsDirty = false;
    }
    
        jsx.Console.GroupEnd();
  },
  
  
  ClearChildren: function() {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].ClearChildren');
        this.DebugPrint();
    
    this.aChildren = [];
    this.bDescendantsDirty = false;
    
        jsx.Console.GroupEnd();
  },
  
  
  SetChildren: function( _a ) {
    this.aChildren.Set_Subtract(_a);
    this.DeleteChildren();
    
    this.aChildren = _a;
    for ( var i = 0, View; View = _a[i]; i++ ) {
      View.Parent = this;
      
      if ( View.bDirty || View.bDescendantsDirty )
        this.SetDescendantsDirty();
    }
  },
  
  
  Destruct: function() {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Destruct');
        this.DebugPrint();
    
    jsx.CObject.prototype.Destruct.call(this);
    
    this.DeleteChildren();
    this.Detach();
    
    //if ( this.Destruct_ )
    //  this.Destruct_();
    
        jsx.Console.GroupEnd();
  },
  
  
  DebugPrint: function() {
    jsx.Console.Log(this, ' | bDirty: '+this.bDirty+', bDescendantsDirty: '+this.bDescendantsDirty+
                ', Children: '+this.aChildren.length);
  }
}
jsx.Extend(jsx.CView, jsx.CObject);

//

jsx.ViewManager = {
  aTopViews: [],
  bUpdateQueued: false,
  
  
  RegisterTopView: function( _View ) {
    jsx.Console.GroupCollapsed('ViewManager.RegisterTopView(',_View,') | '+
              'aTopViews: '+this.aTopViews.length+', bUpdateQueued = '+this.bUpdateQueued);
    
    if ( this.aTopViews.Set_Add_R(_View) ) {
      _View.Parent = this;
      
      if ( _View.bDirty || _View.bDescendantsDirty )
        this.Invalidate();
    }
    
    jsx.Console.GroupEnd();
  },
  
  
  UnregisterTopView: function( _View ) {
    jsx.Console.GroupCollapsed('ViewManager.UnregisterTopView(',_View,') | '+
              'aTopViews: '+this.aTopViews.length+', bUpdateQueued = '+this.bUpdateQueued);
    
    _View.Parent = null;
    this.aTopViews.Delete(_View);
    
    jsx.Console.GroupEnd();
  },
  
  
  SetDescendantsDirty: function() {
    this.Invalidate();
  },
  
  
  Invalidate: function() {
    var t = jsx.ViewManager;
jsx.Console.Group('ViewManager.Invalidate | '+
              'aTopViews: '+t.aTopViews.length+', bUpdateQueued = '+t.bUpdateQueued);
    
    if ( ! t.bUpdateQueued ) {
      jsx.EventDispatcher.Post(t._Update);
      t.bUpdateQueued = true;
    }
jsx.Console.GroupEnd();
  },
  
  
  _Update: function() {
    var t = jsx.ViewManager;
jsx.Console.Group('ViewManager._Update | '+
              'aTopViews: '+t.aTopViews.length+', bUpdateQueued = '+t.bUpdateQueued);
    
    for ( var i = 0, View; View = t.aTopViews[i]; i++ )
      View.Update();
      
    t.bUpdateQueued = false;
jsx.Console.GroupEnd();
  }
}


//

jsx.EventDispatcher = {
  aQueue: [],
  LoopTimeout: 0,
  bLoopStarted: false,
  
  
  StartLoop: function( /*_Timeout*/ ) {
    if ( this.bLoopStarted )
      return;
    this.bLoopStarted = true;
    
    //if ( _Timeout !== undefined )
    //  this.LoopTimeout = _Timeout;
    
    setTimeout(this.LoopCallback, this.LoopTimeout);
  },
  
  
  LoopCallback: function() {
    var t = jsx.EventDispatcher;
jsx.Console.Group('EventDispatcher.LoopCallback | queue: '+t.aQueue.length+', bLoopStarted = '+t.bLoopStarted);
    
    if ( t.aQueue.length )
      t.aQueue.shift().Call();
    
    if ( t.aQueue.length )
      setTimeout(t.LoopCallback, t.LoopTimeout);
    else
      t.bLoopStarted = false;
jsx.Console.GroupEnd();
  },
  
  
  Post: function( _Callback ) {
jsx.Console.Group('EventDispatcher.Post | queue: '+this.aQueue.length+', bLoopStarted = '+this.bLoopStarted);
    if ( typeof(_Callback) == 'function' || _Callback instanceof Array )
      _Callback = new jsx.CCallback(_Callback);
    
    this.aQueue.push(_Callback);
    this.StartLoop();
jsx.Console.GroupEnd();
  },
  
  
  MakeCallback: function( _Callback ) {
    return function() {
jsx.Console.Group('MakeCallback callback');
      if ( typeof(_Callback) == 'function' || _Callback instanceof Array )
        _Callback = new jsx.CCallback(_Callback);
      
      _Callback.Args = arguments;
      
      jsx.EventDispatcher.Post(_Callback);
jsx.Console.GroupEnd();
    }
  }
}

//

jsx.Console = {
  Mode: 'DisableAll',
  Tags: new jsx.Flags,
  
  
  Init: function( _Mode, _Tags ) {
    this.Mode = _Mode;
    this.Tags = new jsx.Flags(_Tags);
  },
  
  
  Log: function() {
    if ( this._Enabled('log', '') )
      console.log.apply(null, arguments);
  },
  Log_T: function( _Tags ) {
    if ( this._Enabled('log', _Tags) )
      console.log.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Warn: function() {
    if ( this._Enabled('warn', '') )
      console.warn.apply(null, arguments);
  },
  
  Error: function() {
    if ( this._Enabled('error', '') )
      console.error.apply(null, arguments);
  },
  
  Assert: function() {
    if ( this._Enabled('assert', '') )
      console.assert.apply(null, arguments);
  },
  Assert_T: function( _Tags ) {
    if ( this._Enabled('assert', _Tags) )
      console.assert.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Group: function() {
    if ( this._Enabled('group', '') )
      console.group.apply(null, arguments);
  },
  Group_T: function( _Tags ) {
    if ( this._Enabled('group', _Tags) )
      console.group.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  GroupCollapsed: function() {
    if ( this._Enabled('groupCollapsed', '') )
      console.groupCollapsed.apply(null, arguments);
  },
  
  GroupEnd: function() {
    if ( this._Enabled('groupEnd', '') )
      console.groupEnd.apply(null, arguments);
  },
  GroupEnd_T: function( _Tags ) {
    if ( this._Enabled('groupEnd', _Tags) )
      console.groupEnd.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Dir: function() {
    if ( this._Enabled('dir', '') )
      console.dir.apply(null, arguments);
  },
  Dir_T: function( _Tags ) {
    if ( this._Enabled('dir', _Tags) )
      console.dir.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Trace: function() {
    if ( this._Enabled('trace', '') )
      console.trace.apply(null, arguments);
  },
  
  Table: function() {
    if ( this._Enabled('table', '') )
      console.table.apply(null, arguments);
  },
  
  
  _Enabled: function( _sMethod, _Tags ) {
    if ( ! (window.console && jQuery.browser.mozilla) )
      return false;
    
    if ( ['warn', 'error', 'assert'].Contains(_sMethod) )
      return true;
    
    switch ( this.Mode ) {
      case 'EnableAll':
        return true;
      case 'EnableTags':
        return this.Tags.IsSet_Any(_Tags);
      case 'DisableAll':
        return false;
    }
    
    return false;
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
// common.js

var J = jQuery;
J.fn.extend({ xsShow: function() { return this.css('display', ''); } });



var owner = window.HTMLElement? window : document;
var prevKeydown = owner.onkeydown;
owner.onkeydown = function(e) {
  if (!e) e = window.event;
  if (e.ctrlKey && (e.keyCode == 192 /*|| e.keyCode == 96*/)) {
    J('#ErrorConsole').show();
    return false;
  }
  if ( prevKeydown ) {
    __prev = prevKeydown;
    return __prev(e);
  }
}


function ErrorConsoleWrite( s ) {
  J('#ErrorConsoleText').append(s.NewLinesToHtml());
  J('#ErrorConsole').show();
}

//

function PreprocessAjaxRes( _Data, _bHandleErrors ) {
  if ( _Data.text.length )
    ErrorConsoleWrite(_Data.text);
  
  if ( _Data.js.Errors && _bHandleErrors )
    ErrorConsoleWrite(_Data.js.Errors.join('\n').Html());
  
  return _Data.js;
}


function OnAjaxSuccess_Global( _Data/*, _sStatus, _Xhr*/ ) {
  return PreprocessAjaxRes(_Data, true);
}


function OnAjaxError_Global( _Xhr, _sStatus, _Ex ) {
  ErrorConsoleWrite( AjaxErrorMsg(_Xhr, _sStatus, _Ex) );
}


function AjaxErrorMsg( _Xhr, _sStatus, _Ex ) {
  if ( _sStatus == 'timeout' )
    var s = 'Тайм-аут';
  else {
    var s = 'Статус: '+_sStatus+'<br>';
    
    if ( _Ex )
      s += 'Исключение: '+_Ex.name+': '+_Ex.message+'<br>';
    
    try {
      var Response = J.parseJSON(_Xhr.responseText);
      var sText = Response ? Response.text : '';
    }
    catch ( Ex ) {
      var a = _Xhr.responseText.match(/"text":"(.*?)"}$/);
      var sText = a[1];
    }
    
    s += 'XMLHttpRequest:<br>&nbsp;&nbsp;'+_Xhr.status+': '+_Xhr.statusText+'<br>'+
         '&nbsp;&nbsp;'+sText.replace(/\\r\\n|\\r|\\n/g, '<br>');
  }
  
  return s;
}

//

jsx.QueryManager = {
  AttachedRequests: {},


  AttachRequest: function( _sAction, _Request, _bAbortOnFail ) {
    this.AttachedRequests[_sAction] = {Request: _Request, AbortOnFail: _bAbortOnFail};
  },
  
  
  GetAttachedRequest: function( _sAction ) {
    return this.AttachedRequests[_sAction] || null;
  },
  
  
  Query: function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    var AttachedRequestData = this.GetAttachedRequest(_sAction);
    if ( AttachedRequestData ) {
      var Request = new jsx.CRequest(_sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
      if ( AttachedRequestData.AbortOnFail )
        Request.AbortOnFail = true;
      this.PacketQuery([Request, AttachedRequestData.Request]);
    }
    else
      this._Query(_sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  _MakeRequest: function( _sUrl, _sAction, _Data, _Timeout ) {
    var Request = { url: _sUrl+'?<?php if ( $bAdminMode ) echo 'admin=1&' ?>Action='+_sAction,
                    data: J.toJSON(_Data) };
    if ( _Timeout )
      Request.timeout = _Timeout;
    return Request;
  },
  
  
  _Query_: function( _sUrl, _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    var Request = this._MakeRequest(_sUrl, _sAction, _Data, _Timeout);
    
    var SuccessCB, ErrorCB, CompleteCB;
    
    if ( typeof(_Callbacks) == 'function' )
      SuccessCB = _Callbacks;
    else if ( _Callbacks instanceof Array ) {
      var Obj;
      if ( typeof(_Callbacks[0]) == 'object' || _Callbacks[0] === undefined ) //'object' - obj or null
        Obj = _Callbacks.shift();
      
      SuccessCB = _Callbacks[0];
      
      switch ( _Callbacks.length ) {
        case 3:
          ErrorCB = _Callbacks[1];
          CompleteCB = _Callbacks[2];
          break;
        case 2:
          CompleteCB = _Callbacks[1];
          break;
      }
    }
    
    if ( SuccessCB ) {
      if ( typeof(SuccessCB) == 'function' && Obj )
        SuccessCB = [Obj, SuccessCB];
      
      Request.success = jsx.EventDispatcher.MakeCallback(function( _Res, _sStatus, _Xhr ) {
        //if ( _Res.js.Errors == 'SessionExpired' ) {
        //  window.location = window.location.href.replace(/#.*$/, '');
        //  return;
        // }
        
        _Res = PreprocessAjaxRes(_Res, ! _bCaptureErrors);
        
        jsx.Call(SuccessCB, _Res);
      });
    }
    
    if ( ErrorCB ) {
      if ( typeof(ErrorCB) == 'function' && Obj )
        ErrorCB = [Obj, ErrorCB];
      
      Request.error = jsx.EventDispatcher.MakeCallback(function( _Xhr, _sStatus, _Ex ) {
        jsx.Call(ErrorCB, _Xhr, _sStatus, _Ex);
      });
    }
    
    if ( CompleteCB ) {
      if ( typeof(CompleteCB) == 'function' && Obj )
        CompleteCB = [Obj, CompleteCB];
      
      Request.complete = jsx.EventDispatcher.MakeCallback(function( _Xhr, _sStatus, _Ex ) {
        jsx.Call(CompleteCB, _Xhr, _sStatus);
      });
    }
    
    J.ajax(Request);
  },
  
  
  _Query: function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    this._Query_(C_sBackEnd, _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  Query_Obj: function( _RequestObj, _sMethod, _aArgs, _Callbacks, _bCaptureErrors, _Timeout ) {
    var RequestData = _RequestObj;
    RequestData.Method = _sMethod;
    RequestData.Args = _aArgs;
    
    this._Query('CallMethod', RequestData, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  PacketQuery: function( _aRequests, _CompleteCallback, _Timeout ) {
    var aCallbacks = new Array(_aRequests.length);
    var iTimeout = 0;
    
    for ( var i = 0, Request; Request = _aRequests[i]; ++i ) {
      var CBData = aCallbacks[i] = {};
      if ( Request.Callback ) {
        CBData.Callback = typeof(Request.Callback) == 'function' ?
                          [Request.Obj, Request.Callback] : Request.Callback;
        delete Request.Callback;
      }
      if ( Request.CaptureErrors ) {
        CBData.CaptureErrors = Request.CaptureErrors;
        delete Request.CaptureErrors;
      }
      
      if ( Request.Obj ) {
        J.extend(Request, Request.Obj.GetRequestObject());
        delete Request.Obj;
      }
      
      if ( ! _Timeout )
        iTimeout += Request.Timeout ? Number(Request.Timeout) : C_GeneralTimeout;
      if ( Request.Timeout )
        delete Request.Timeout;
    }
    
    var fnCB = function( _Res ) {
      for ( var i = 0; i < _Res.Data.length; ++i ) {
        var Data = _Res.Data[i];
        var CBData = aCallbacks[i];
        
        if ( ! CBData.CaptureErrors && Data.Errors )
          ErrorConsoleWrite(Data.Errors.join('\n').Html());
        
        if ( CBData.Callback )
          jsx.Call(CBData.Callback, Data);
      }
    };
    
    var CB = _CompleteCallback ? [fnCB, _CompleteCallback] : fnCB;
    
    this._Query('PacketQuery', _aRequests, CB, false, _Timeout);
  }
}



jsx.CRequest = function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
  this.Action = _sAction;
  this.Data = _Data;
  this.Callbacks = _Callbacks;
  this.CaptureErrors = _bCaptureErrors;
  this.Timeout = _Timeout;
}

//

function RenderErrorMsg( _$Msg, _aErrors ) {
  _$Msg.html(_aErrors.join('\n').HtmlEncode().NewLinesToHtml());
}

function ShowErrorMsg( _IDP, _Error ) {
  var $Msg = J('#'+_IDP+'Msg');
  if ( _Error instanceof Array )
    RenderErrorMsg($Msg, _Error);
  else
    $Msg.text(_Error);
  
  J('#'+_IDP+'MsgBox').xsShow();
}

function HideErrorMsg( _IDP ) {
  J('#'+_IDP+'MsgBox').hide();
  J('#'+_IDP+'Msg').empty();
}

//

function CViewField( _Data, _sName, _IDP, _Encoder, _bComplex, _HideBoxIfEmpty, _fnRender ) {
  this.Data = _Data;
  this.sName = _sName;
  this.DID = _IDP+_sName;
  
  this.Encoder = J.extend({}, _Encoder);
  if ( this.Encoder.IsSet )
    this.Encoder.IsSet = new jsx.CCallback(this.Encoder.IsSet);
  if ( this.Encoder.Encode )
    this.Encoder.Encode = new jsx.CCallback(this.Encoder.Encode);
  
  this.bComplex = Boolean(_bComplex);
  this.HideBoxIfEmpty = _HideBoxIfEmpty;
  this.fnRender = _fnRender || _fnRender === false ? _fnRender : RenderField_Text;
}
CViewField.prototype = {
  Update: function() {
    var $Box = J('#'+this.DID+'Box');
    var v = this.bComplex ? this.Data : this.Data[this.sName];
    
    var Encoded;
    if ( (this.HideBoxIfEmpty == 'hide&render' || this.HideBoxIfEmpty == 'hide') &&
         ( (this.Encoder.IsSet) && ! this.Encoder.IsSet.Call(v) ||
           ! (this.Encoder.IsSet) && ! (Encoded = this.Encode(v)) ) )
    {
      $Box.hide();
      if ( this.HideBoxIfEmpty == 'hide&render' && this.fnRender )
        this.fnRender(J('#'+this.DID), Encoded !== undefined ? Encoded : this.Encode(v));
    }
    else {
      if ( this.fnRender )
        this.fnRender(J('#'+this.DID), Encoded !== undefined ? Encoded : this.Encode(v));
      if ( this.HideBoxIfEmpty )
        $Box.show();
    }
  },
  
  Encode: function( _v ) {
    return this.Encoder.Encode ? this.Encoder.Encode.Call(_v) : (_v != null ? String(_v) : '');
  }
}


function CViewField_Proxy( _Callback ) {
  this.Callback = new jsx.CCallback(_Callback);
}
CViewField_Proxy.prototype = {
  Update: function() { this.Callback.Call(); }
}


var g_FieldEncoder_Text = {
  IsSet: function( _s ) { return _s.length; }
}
var g_FieldEncoder_Bool_True = {
  IsSet: function( _b ) { return Boolean(_b); }
}
var g_FieldEncoder_Number_NonZero = {
  IsSet: function( _v ) { return Boolean(Number(_v)); }
}

var g_FieldEncoder_UnixTimestampToLocaleDate = {
  Encode: function( _v ) {
    if ( _v == null )
      return '';
    
    var DT = new Date(_v * 1000);
    return DT.toLocaleDateString();
  }
}

var g_FieldEncoder_UnixTimestampToLocaleDateTime = {
  Encode: function( _v ) {
    if ( _v == null )
      return '';
    
    var DT = new Date(_v * 1000);
    return DT.toLocaleString();
  }
}

var g_FieldEncoder_NewLinesToHtml = {
  Encode: function( _s ) { return _s.NewLinesToHtml(); }
}

var g_FieldEncoder_Html = {
  Encode: function( _s ) { return _s.Html(); }
}

var g_FieldEncoder_BBCodeToHtml = {
  Encode: function( _s ) {
    _s = _s.HtmlEncode();
    
    _s = _s.replace(/\[img\](.+?)\[\/img\]/ig, "<img src='files/$1' />");
    
    return _s.NewLinesToHtml();
  }
}

function RenderField_Text( _$El, _s ) { _$El.text(_s); }
function RenderField_Html( _$El, _s ) { _$El.html(_s); }
function RenderField_ImgSrc( _$El, _s ) { _$El.attr('src', _s); }
function RenderField_Href( _$El, _s ) {
  if ( _s != null )
    _$El.attr('href', _s);
  else
    _$El.removeAttr('href');
}

function RenderField_Link( _$a, _s ) {
  if ( _s != null )
    _$a.attr('href', _s).text(_s);
  else
    _$a.removeAttr('href').text('');
}

function RenderField_jQuery( _$El, _$ ) {
  _$El.empty();
  if ( _$ )
    _$El.append(_$);
}

//

function CFormField( _Form, _ID, _Validator, _bNotEmpty ) {
  this.Form = _Form;
  this.ID = _ID;
  this.Validator = _Validator;
  this.bNotEmpty = Boolean(_bNotEmpty);
  
  this.DID = this.Form.IDP()+this.ID;
  this.Init();
}
CFormField.prototype = {
  Init: function() {
    var t = this;
    J('#'+this.DID).change(function(){ t.OnChange(J(this).val()); });
  },
  
  SetVal: function( _v ) {
    J('#'+this.DID).val(_v || '');
    this.Form.FieldValid(this.ID, this._Valid(_v));
  },
  
  Val: function() {
    return J('#'+this.DID).val();
  },
  
  OnChange: function( _s ) {
    this.Form.FieldValid(this.ID, this._Valid(_s));
  },
  
  Valid: function() {
    return this._Valid(this.Val());
  },
  
  _Valid: function( _v ) {
    if ( (_v == null || _v === '') && this.bNotEmpty )
      return false;
    return ! this.Validator || this.Validator.Valid(_v);
  }
}

//

function InsertTextAtCursor( _Textarea, _s) {
  _Textarea.focus();
  if (document.selection && document.selection.createRange) {
    var r = document.selection.createRange();
    r.text = _s;
  }
  else if (_Textarea.setSelectionRange) {
    var start = _Textarea.selectionStart;
    var end   = _Textarea.selectionEnd;
    var sel1  = _Textarea.value.substr(0, start);
    var sel2  = _Textarea.value.substr(end);
    _Textarea.value   = sel1 + _s + sel2;
    _Textarea.setSelectionRange(start+_s.length, start+_s.length);
  }
  else
    _Textarea.value += _s;
  
  // For IE.
  //setTimeout(function() { _Textarea.focus() }, 100);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

var DBG = true;
var Console = jsx.Console;
Console.Init('EnableAll');

<?php if ( $bAdminMode ) { ?>
////////////////////////////////////////////////////////////////////////////////////////////////////
// admin.js

var O = jsx.ObjectRepository;

var g_Installer;



function Init() {
      Console.Group('Init');
  
  //if ( sInitErrors ) {
  //  ErrorConsoleWrite(sInitErrors);
  //  return;
  // }
  
  J.ajaxSetup({
    cache: false,
    timeout: C_GeneralTimeout,
    type: 'POST',
    success: OnAjaxSuccess_Global,
    error: OnAjaxError_Global
  });
  
  g_Installer = new CInstaller;
  var View = new CInstallerView('A_Contents');
  jsx.ViewManager.RegisterTopView(View);
  g_Installer.AddView(View);
  g_Installer.Update();
  
      Console.GroupEnd();
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function CInstaller() {
  jsx.CModel.call(this);
  
  this.Data = {};
  
  this.bUpdating = false;
  this.UpdateRes = null;
  this.bInstalling = false;
  this.InstallRes = null;
  this.SavingConfig = false;
  this.SaveConfigRes = null;
  
  this.sInstallLog = null;
}

CInstaller.prototype = {
  sClass: 'Installer',
  
  Update: function() {
    if ( this.bUpdating )
      return;
    
    this.UpdateRes = null;
    this.bUpdating = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.Query_Obj(this.GetRequestObject(), 'CheckInstall', null, [this,
      function( _Res ) {
            Console.Group("CInstaller 'CheckInstall' success callback");
        
        if ( _Res.Ok ) {
          this.UpdateData(_Res.Install);
          
          this.UpdateRes = true;
        }
        else
          this.UpdateRes = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CInstaller 'CheckInstall' complete callback");
        
        this.bUpdating = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  Install: function( _Params ) {
    if ( this.bInstalling || this.bUpdating )
      return;
    
    this.InstallRes = this.UpdateRes = null;
    this.bInstalling = this.bUpdating = true;
    this.InvalidateViews({Installing: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Obj: this, Method: 'Install', Args: [_Params],
          CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'Install'(packet) success callback");
            
            this.sInstallLog = _Res.Log;
            
            this.InstallRes = _Res.Ok ? true : _Res.Errors || false;
            
                Console.GroupEnd();
        } }
      ],
      [this, function() {
            Console.Group("CInstaller 'Install/CheckInstall'(packet) complete callback");
        
        this.bInstalling = this.bUpdating = false;
        this.InvalidateViews({Installing: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
  },
  
  
  SaveConfig: function( _Params ) {
    this.SaveConfigRes = this.UpdateRes = null;
    this.bSavingConfig = this.bUpdating = true;
    this.InvalidateViews({SavingConfig: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Obj: this, Method: 'SaveConfig', Args: [_Params], CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'SaveConfig'(packet) success callback");
            
            this.SaveConfigRes = _Res === true ? true : _Res.Errors || false;
            
                Console.GroupEnd();
        } },
        { Obj: this, Method: 'CheckInstall', CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'CheckInstall' success callback");
            
            if ( _Res.Ok ) {
              this.UpdateData(_Res.Install);
              
              this.UpdateRes = true;
            }
            else
              this.UpdateRes = _Res.Errors || false;
            
                Console.GroupEnd();
        } }
      ],
      [this, function() {
            Console.Group("CInstaller 'SaveConfig/CheckInstall'(packet) complete callback");
        
        this.bSavingConfig = this.bUpdating = false;
        this.InvalidateViews({SavingConfig: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
  },
  
  
  GetRequestObject: function() {
    return {Class: this.sClass};
  }
}
jsx.Extend(CInstaller, jsx.CModel);



function CInstallerView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.InstallView = null;
  this.ConfigView = null;
}
CInstallerView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CInstallerView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.Updating ) {
      //HideErrorMsg(this.DID);
      //J('#'+this.DID+'Wait').show();
    }
    else if ( _Hints.Updating === false ) {
      if ( M.UpdateRes === true ) {
        if ( D.InstallOk ) {
          if ( this.InstallView ) {
            this.DeleteChild(this.InstallView);
            this.InstallView = null;
          }
          
          if ( ! this.ConfigView ) {
            this.ConfigView = new CConfigView(this.DID);
            M.AddView(this.ConfigView);
            this.AddChild(this.ConfigView);
          }
        }
        else {
          if ( this.ConfigView ) {
            this.DeleteChild(this.ConfigView);
            this.ConfigView = null;
          }
          
          if ( ! this.InstallView ) {
            this.InstallView = new CInstallView(this.DID);
            M.AddView(this.InstallView);
            this.AddChild(this.InstallView);
          }
        }
      }
      
      //J('#'+this.DID+'Wait').hide();
    }
      
        Console.GroupEnd();
    return true;
  }
}
jsx.Extend(CInstallerView, jsx.CView);



function CInstallView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CInstallView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CInstallView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_A_Install
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.Fields.DB_Host = new CFormField(this, 'DB_Host', null, true);
      this.Fields.DB_User = new CFormField(this, 'DB_User', null, true);
      this.Fields.DB_Password = new CFormField(this, 'DB_Password', null, true);
      this.Fields.DB_DBName = new CFormField(this, 'DB_DBName', null, true);
      
      this.Fields.AdminLogin =
        new CFormField(this, 'AdminLogin', null /*new CValidator(ValidationRules_Login)*/, true);
      this.Fields.AdminPassword =
        new CFormField(this, 'AdminPassword', null, true);
      this.Fields.AdminPassword2 =
        new CFormField(this, 'AdminPassword2', null, true);
      
      for ( var sField in this.Fields )
        this.Fields[sField].SetVal(D.Config && D.Config[sField]);
      
      J('#'+this.DID+'InstallBtn').click(function(){ t.Install(); });
      J('#'+this.DID+'GoToConfigTrigger').click(function(){ M.Update(); });
    }
    else
    if ( _Hints.Installing ) {
      J('#'+this.DID+'InstallWait').show();
      J('#'+this.DID+'InstallLog').hide();
      HideErrorMsg(this.DID+'Install');
      J('#'+this.DID+'GoToConfigTrigger').hide();
    }
    else if ( _Hints.Installing === false ) {
      if ( M.InstallRes === true ) {
        J('#'+this.DID+'GoToConfigTrigger').show();
      }
      else
        ShowErrorMsg(this.DID+'Install', M.InstallRes ? M.InstallRes : 'Ошибка');
      
      J('#'+this.DID+'InstallWait').hide();
      J('#'+this.DID+'InstallLog').html(M.sInstallLog.HtmlEncode().NewLinesToHtml()).show();
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Install: function() {
    var Params = {};
    for ( var sField in this.Fields )
      if ( sField != 'AdminPassword2' )
        Params[sField] = this.Fields[sField].Val();
    
    this.Model.Install(Params);
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'InstallBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) &&
         this.Fields.AdminPassword.Val() == this.Fields.AdminPassword2.Val() )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CInstallView, jsx.CView);



function CConfigView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CConfigView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CConfigView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_A_Config
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.Fields.SiteTitle = new CFormField(this, 'SiteTitle');
      this.Fields.NumMsgsOnPage = new CFormField(this, 'NumMsgsOnPage');
      this.Fields.Template = new CFormField(this, 'Template');
      this.Fields.FileSystemEncoding = new CFormField(this, 'FileSystemEncoding');
      
      for ( var sField in this.Fields )
        this.Fields[sField].SetVal(D.Config && D.Config[sField]);
      
      J('#'+this.DID+'ApplyBtn').click(function(){ t.Apply(); });
    }
    else {
      if ( _Hints.SavingConfig ) {
        HideErrorMsg(this.DID+'Apply');
        J('#'+this.DID+'ApplyWait').show();
      }
      else if ( _Hints.SavingConfig === false ) {
        if ( M.SaveConfigRes === true ) {
        }
        else
          ShowErrorMsg(this.DID+'Apply', M.SaveConfigRes ? M.SaveConfigRes : 'Ошибка');
        
        J('#'+this.DID+'ApplyWait').hide();
      }
      
      if ( _Hints.Updating === false && M.UpdateRes === true )
        for ( var sField in this.Fields )
          this.Fields[sField].SetVal(D.Config && D.Config[sField]);
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Apply: function() {
    var Params = {};
    for ( var sField in this.Fields )
      Params[sField] = this.Fields[sField].Val();
    
    this.Model.SaveConfig(Params);
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'ApplyBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CConfigView, jsx.CView);

<?php } else { ?>
////////////////////////////////////////////////////////////////////////////////////////////////////
// client.js

var O = jsx.ObjectRepository;

var g_GuestBook;



function GetFileUploadResponse( xhr ) {
  if ( xhr.responseText !== undefined )
    return xhr.responseText;
  else
    // Instead of an XHR object, an iframe is used for legacy browsers:
    return xhr.contents().text();
};

////////////////////////////////////////////////////////////////////////////////////////////////////

function Init() {
      Console.Group('Init');
  
  if ( sInitErrors ) {
    ErrorConsoleWrite(sInitErrors);
    return;
  }
  
  J.ajaxSetup({
    cache: false,
    timeout: C_GeneralTimeout,
    type: 'POST',
    success: OnAjaxSuccess_Global,
    error: OnAjaxError_Global
  });
  
  g_GuestBook = new CGuestBook;
  var View = new CGuestBookView('Main');
  jsx.ViewManager.RegisterTopView(View);
  g_GuestBook.AddView(View);
  g_GuestBook.Init();
  
      Console.GroupEnd();
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function CGuestBook() {
  jsx.CModel.call(this);
  
  this.bPending = false;
  this.Res = null;
  
  this.MsgMan = new CMsgManager;
}

CGuestBook.prototype = {
  sClass: 'GuestBook',
  
  Init: function() {
    this.MsgMan.UpdatePage(1);
  },
  
  
  Register: function( _sLogin, _sPassword ) {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({Registering: true});
    
    jsx.QueryManager.Query('Register', {Login: _sLogin, Password: _sPassword}, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'Register' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = _sLogin;
          g_iUserGroup = _Res.UserGroup;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'Register' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Registering: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  LogIn: function( _sLogin, _sPassword ) {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({LoggingIn: true});
    
    jsx.QueryManager.Query('LogIn', {Login: _sLogin, Password: _sPassword}, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'LogIn' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = _sLogin;
          g_iUserGroup = _Res.UserGroup;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'LogIn' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({LoggingIn: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  LogOut: function() {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({LoggingOut: true});
    
    jsx.QueryManager.Query('LogOut', null, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'LogOut' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = 'guest';
          g_iUserGroup = UserGroup_Guest;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'LogOut' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({LoggingOut: false});
        
            Console.GroupEnd();
      }]
    );
  }
}
jsx.Extend(CGuestBook, jsx.CModel);



function CGuestBookView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.RegisterView = null;
  this.MsgManView = null;
}
CGuestBookView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CGuestBookView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_Main.replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.MsgManView = new CMsgManagerView('MsgManager');
      M.MsgMan.AddView(this.MsgManView);
      this.AddChild(this.MsgManView);
      
      this.AdaptToUserGroup();
    }
    else {
      if ( _Hints.Registering === false && M.Res === true ) {
        this.DeleteChild(this.RegisterView);
        this.RegisterView = null;
        
        J('#Register').empty();
        
        this.AdaptToUserGroup();
      }
      
      if ( _Hints.LoggingIn ) {
        HideErrorMsg('LogIn');
        J('#LogInWait').show();
      }
      else if ( _Hints.LoggingIn === false ) {
        J('#LogInWait').hide();
        
        if ( M.Res === true ) {
          J('#LogInBox').hide();
          this.AdaptToUserGroup();
        }
        else
          ShowErrorMsg('LogIn', M.Res ? M.Res : 'Ошибка');
      }
      
      if ( _Hints.LoggingOut ) {
        //HideErrorMsg('LogOut');
        //J('#LogOutWait').show();
      }
      else if ( _Hints.LoggingOut === false ) {
        //J('#LogOutWait').hide();
        
        if ( M.Res === true )
          this.AdaptToUserGroup();
        //else
        //  ShowErrorMsg('LogOut', M.Res ? M.Res : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  AdaptToUserGroup: function() {
    var t = this;
    var M = this.Model;
    
    if ( g_iUserGroup == UserGroup_Guest ) {
      J('#UserBlock_User').hide();
      J('#UserBlock_Guest').show();
      
      J('#ToggleLogInPaneTrigger').unbind('click').click(function(){ t.ToggleLogInPane(); });
      J('#LogInBtn').unbind('click').click(function(){ t.LogIn(); });
      
      J('#ToggleRegisterPaneTrigger').unbind('click').click(function(){ t.ToggleRegisterPane(); });
    }
    else {
      J('#UserBlock_Guest').hide();
      
      J('#UserBlock_User').show();
      J('#Login').text(g_sUserLogin);
      J('#LogOutTrigger').unbind('click').click(function(){ M.LogOut(); });
      
      if ( g_iUserGroup == UserGroup_Admin )
        J('#UserBlock_Admin').show();
      else
        J('#UserBlock_Admin').hide();
    }
  },
  
  
  ToggleLogInPane: function() {
    $LogInBox = J('#LogInBox');
    
    if ( ! $LogInBox.is(':visible') && this.RegisterView ) {
      this.DeleteChild(this.RegisterView);
      this.RegisterView = null;
      
      J('#Register').empty();
    }
      
    $LogInBox.toggle();
  },
  
  
  ToggleRegisterPane: function() {
    if ( this.RegisterView ) {
      this.DeleteChild(this.RegisterView);
      this.RegisterView = null;
      
      J('#Register').empty();
    }
    else {
      J('#LogInBox').hide();
      
      this.RegisterView = new CRegisterView('Register');
      this.Model.AddView(this.RegisterView);
      this.AddChild(this.RegisterView);
    }
  },
  
  
  LogIn: function() {
    this.Model.LogIn( J('#LogIn_Login').val(), J('#LogIn_Password').val() );
  }
}
jsx.Extend(CGuestBookView, jsx.CView);



function CRegisterView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CRegisterView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CRegisterView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_Register.replace(/%IDP%/gi, this.DID)
                                                .replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.Fields.Login =
        new CFormField(this, 'Login', null /*new CValidator(ValidationRules_Login)*/, true);
      this.Fields.Password =
        new CFormField(this, 'Password', null, true);
      this.Fields.Password2 =
        new CFormField(this, 'Password2', null, true);
      
      J('#'+this.DID+'RegisterBtn').attr('disabled', true)
        .unbind('click').click(function(){ t.Register(); });
    }
    
    if ( _Hints.Registering ) {
      HideErrorMsg(this.DID);
      J('#'+this.DID+'Wait').show();
    }
    else if ( _Hints.Registering === false ) {
      if ( M.Res !== true )
        ShowErrorMsg(this.DID, M.Res ? M.Res : 'Ошибка');
      
      J('#'+this.DID+'Wait').hide();
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Register: function() {
    this.Model.Register( J('#'+this.DID+'Login').val(), J('#'+this.DID+'Password').val() );
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'RegisterBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) &&
         this.Fields.Password.Val() == this.Fields.Password2.Val() )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CRegisterView, jsx.CView);



function CMsgManager() {
  jsx.CModel.call(this);
  
  this.aMsgs = [];
  
  this.TotalCount = 0;
  this.PageCount = 0;
  this.PageNum = 1;
  
  this.bPending = false;
  this.UpdateRes = null;
  this.OpRes = null;
  
  this.Msg = null;
  if ( g_iUserGroup == UserGroup_User || g_iUserGroup == UserGroup_Admin )
    this.Msg = new CMsg(this);
}

CMsgManager.prototype = {
  sClass: 'MsgManager',
  
  UpdatePage: function( _PageNum ) {
        Console.Group('CMsgManager.UpdatePage');
    
    this.PageNum = _PageNum;
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.Query('GetMsgs', {Page: {Num: _PageNum}},
      [this, this._GetMsgsCallback,
      function() {
            Console.Group("CMsgManager 'GetMsgs' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }],
      true
    );
    
        Console.GroupEnd();
  },
  
  
  NextPage: function() {
    if ( this.PageNum >= this.PageCount )
      return;
    
    this.UpdatePage(this.PageNum + 1);
  },
  
  PrevPage: function() {
    if ( this.PageNum == 1 )
      return;
    
    this.UpdatePage(this.PageNum - 1);
  },
  
  
  CreateMsg: function( _sText, _aMsgCallbacks ) {
        Console.Group('CMsgManager.CreateMsg');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Action: 'PostMsg', Data: {Text: _sText},
          AbortOnFail: true, CaptureErrors: true,
          Callback: [this, function( _Res ) {
                Console.Group("CMsgManager 'PostMsg'(packet) success callback");
            
            if ( _Res.Ok ) {
              jsx.Destruct(this.Msg);
              this.Msg = new CMsg(this);
              
              this.InvalidateViews({NewMsg: true});
            }
            else
              _aMsgCallbacks[0].call(this.Msg, _Res);
            
            //this.OpRes = _Res.Ok ? true : _Res.Errors || false;
            
                Console.GroupEnd();
          }]},
        { Action: 'GetMsgs', CaptureErrors: true,
          Data: {Page: {Containing: C_sPacketQueryContextValue}},
          Callback: [this, this._GetMsgsCallback]}
      ],
      [this, function() {
            Console.Group("CMsgManager 'Post/GetMsgs'(packet) complete callback");
        
        _aMsgCallbacks[1].call(this.Msg);
        
        this.bPending = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  },
  
  
  ChangeMsg: function( _Msg, _sText, _aMsgCallbacks ) {
        Console.Group('CMsgManager.ChangeMsg');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.bPending = true;
    
    jsx.QueryManager.Query('ChangeMsg', {ID: _Msg.ID, Text: _sText}, [this,
      function( _Res ) {
            Console.Group("CMsgManager 'ChangeMsg' success callback");
        
        _aMsgCallbacks[0].call(_Msg, _Res);
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CMsgManager 'ChangeMsg' complete callback");
        
        _aMsgCallbacks[1].call(_Msg);
        
        this.bPending = false;
        
            Console.GroupEnd();
      }],
      true
    );
    
        Console.GroupEnd();
  },
  
  
  Delete: function( _Msg, _aMsgCallbacks ) {
        Console.Group('CMsgManager.Delete');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Deleting: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Action: 'DeleteMsg', Data: {ID: _Msg.ID}, CaptureErrors: true,
          Callback: [this, function( _Res ) {
                Console.Group("CMsgManager 'DeleteMsg'(packet) success callback");
            
            this.OpRes = _Res === true ? true : _Res.Errors || false;
            
                Console.GroupEnd();
          }]},
        { Action: 'GetMsgs', Data: {Page: {Num: this.PageNum}}, CaptureErrors: true,
          Callback: [this, this._GetMsgsCallback] }
      ],
      [this, function() {
            Console.Group("CMsgManager 'Delete/GetMsgs'(packet) complete callback");
        
        _aMsgCallbacks[1].call(_Msg);
        
        this.bPending = false;
        this.InvalidateViews({Deleting: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  },
  
  
  OnUserChanged: function() {
    this.UpdatePage(this.PageNum);
    
    if ( g_iUserGroup == UserGroup_User || g_iUserGroup == UserGroup_Admin ) {
      if ( ! this.Msg )
        this.Msg = new CMsg(this);
    }
    else {
      jsx.Destruct(this.Msg);
      this.Msg = null;
    }
    
    this.InvalidateViews({UserChanged: true})
  },
  
  
  _GetMsgsCallback: function( _Res ) {
        Console.Group("CMsgManager 'GetMsgs' success callback");
    
    if ( _Res.Ok ) {
      var aMsgs = new Array(_Res.Msgs.length);
      for ( var i = 0, Data; Data = _Res.Msgs[i]; i++ ) {
        var Msg = O.Get('Msg', Data.ID);
        Msg.Manager = this;
        Msg.UpdateData(Data);
        aMsgs[i] = Msg;
      }
      O.Release(this.aFilms);
      this.aMsgs = aMsgs;
      
      if ( _Res.Users )
        for ( var i = 0, Data; Data = _Res.Users[i]; i++ )
          O.GetWeak('User', Data.ID).UpdateData(Data);
      
      this.TotalCount = _Res.TotalCount;
      this.PageCount = Math.ceil(this.TotalCount / C_iNumMsgsOnPage);
      
      if ( _Res.PageNum )
        this.PageNum = _Res.PageNum;
      
      this.UpdateRes = true;
    }
    else
      this.UpdateRes = _Res.Errors || false;
    
        Console.GroupEnd();
  }
}
jsx.Extend(CMsgManager, jsx.CModel);



function CMsgManagerView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.MsgsView = null;
  this.MsgView = null;
}
CMsgManagerView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgManagerView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      this.MsgsView = new CMsgsView('Msgs');
      M.AddView(this.MsgsView);
      this.AddChild(this.MsgsView);
      
      this.AdaptToUserGroup();
    }
    else {
      if ( _Hints.NewMsg ) {
        if ( this.MsgView ) {
          J('#MsgEdit').empty();
          this.DeleteChild(this.MsgView);
        }
        
        this.MsgView = new CMsgEditView('MsgEdit');
        M.Msg.AddView(this.MsgView);
        this.AddChild(this.MsgView);
      }
      
      if ( _Hints.UserChanged )
        this.AdaptToUserGroup();
      
      if ( _Hints.Deleting ) {
        HideErrorMsg('Msgs');
        //J('#'+this.DID+'Wait').show();
      }
      else if ( _Hints.Deleting === false ) {
        //J('#'+this.DID+'Wait').hide();
        
        if ( M.OpRes !== true )
          ShowErrorMsg('Msgs', M.OpRes ? M.OpRes : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  AdaptToUserGroup: function() {
    var M = this.Model;
    
    if ( g_iUserGroup == UserGroup_Guest ) {
      J('#PostBlock_User').hide();
      J('#PostBlock_Guest').show();
    }
    else {
      J('#PostBlock_Guest').hide();
      J('#PostBlock_User').show();
    }
    
    if ( M.Msg ) {
      if ( ! this.MsgView ) {
        this.MsgView = new CMsgEditView('MsgEdit');
        M.Msg.AddView(this.MsgView);
        this.AddChild(this.MsgView);
      }
    }
    else {
      if ( this.MsgView ) {
        J('#MsgEdit').empty();
        this.DeleteChild(this.MsgView);
        this.MsgView = null;
      }
    }
  }
}
jsx.Extend(CMsgManagerView, jsx.CView);



function CMsgsView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.aNavViews = [];
  this.aMsgViews = [];
}
CMsgsView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgsView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      this.RenderMsgs(true);
    }
    else {
      if ( _Hints.Updating ) {
        HideErrorMsg(this.DID);
        //J('#'+this.DID+'Wait').show();
      }
      else if ( _Hints.Updating === false ) {
        //J('#'+this.DID+'Wait').hide();
        
        // M.UpdateRes == null when post part of post/get packet query fails
        if ( M.UpdateRes != null )
          this.RenderMsgs();
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  RenderMsgs: function( _bInitial ) {
    var M = this.Model, D = M.Data;
    
    if ( M.PageCount > 1 ) {
      if ( ! this.aNavViews.length ) {
        var NavView = new CMsgsView_Navigation('MsgsNavTop');
        M.AddView(NavView);
        this.aNavViews.push(NavView);
        NavView = new CMsgsView_Navigation('MsgsNavBottom');
        M.AddView(NavView);
        this.aNavViews.push(NavView);
      }
    }
    else {
      this.aNavViews = [];
      
      J('#MsgsNavTop').empty();
      J('#MsgsNavBottom').empty();
    }
    
    if ( _bInitial || M.UpdateRes === true ) {
      var aOldMsgViews = this.aMsgViews.slice(0);
      this.aMsgViews = [];
      
      var $El = J('#MsgsList').empty();
      
      var $Tbl = J('<table>', {'class': 'Msgs'});
      var MsgView, a;
      
      for ( var i = 0, Msg; Msg = M.aMsgs[i]; i++ ) {
        var DID = 'Msg'+Msg.ID;
        
        $Tbl.append( J('<tr>', {id: DID, 'class': 'Msg '+(i % 2 ? 'Odd' : 'Even')}) );
        
        if ( (a = aOldMsgViews.Set_Extract(Msg.aViews)).length ) {
          MsgView = a[0];
          MsgView.Invalidate({all: true});
        }
        else {
          MsgView = new CMsgView(DID);
          Msg.AddView(MsgView);
        }
        this.aMsgViews.push(MsgView);
      }
      
      $El.append($Tbl);
      
      this.SetChildren(this.aNavViews.concat(this.aMsgViews));
    }
    else {
      J('#MsgsList').empty();
      ShowErrorMsg('Msgs', M.UpdateRes ? M.UpdateRes : 'Ошибка');
    }
  }
}
jsx.Extend(CMsgsView, jsx.CView);



function CMsgsView_Navigation( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}

CMsgsView_Navigation.prototype = {
  Update_: function() {
        Console.Group('CMsgsView_Navigation.Update_');
    
    var M = this.Model;
    
    var $El = J('#'+this.DID).empty();
    
    if ( ! M.PageCount || M.PageCount == 1 ) {
          Console.GroupEnd();
      return true;
    }
    
    var sPrev = '&larr; предыдущая';
    var sNext = 'следующая &rarr;';
    
    $El.append('Страницы: ')
    $El.append(
      M.PageNum > 1 ?
        J('<a>', {'class': 'Clickable'}).html(sPrev).click(function(){ M.PrevPage(); }) :
        J('<span>', {'class': 'Disabled'}).html(sPrev),
      '&nbsp;' );
    for ( var i = 1; i <= M.PageCount; i++ ) {
      var bNum = i == 1 || i == M.PageCount || Math.abs(i-M.PageNum) <= 4 ||
                 i/10 == Math.round(i/10);
      var s = bNum ? i : '.';
      
      var $a = J('<a>', {'class': 'Clickable PageLink'}).text(s).click(this.Make_Page_OnClick(i));
      $a.addClass( bNum ? 'Number' : 'Dot' );
      if ( i == M.PageNum )
        $a.addClass('Current');
      if ( ! bNum )
        $a.attr('title', i);
      
      $El.append( $a );
    }
    $El.append(
      '&nbsp;',
      M.PageNum < M.PageCount ?
        J('<a>', {'class': 'Clickable'}).html(sNext).click(function(){ M.NextPage(); }) :
        J('<span>', {'class': 'Disabled'}).html(sNext) );
    
        Console.GroupEnd();
    return true;
  },
  
  
  Make_Page_OnClick: function( _PageNum ) {
    var M = this.Model;
    return function(){ M.UpdatePage(_PageNum); }
  }
}
jsx.Extend(CMsgsView_Navigation, jsx.CView);



function CMsg( _MsgManager ) {
  jsx.CModel.call(this);
  
  this.Data = {};
  this.User = null;
  
  this.Manager = _MsgManager;
  
  this.$FileUpload = null;
  this.aFiles = [];
  
  this.bPending = false;
  this.Res = null;
  this.sSendingText = null;
}

CMsg.prototype = {
  sClass: 'Msg',
  
  UpdateData: function( _Data ) {
    var Changed = {};
    
    for ( var Key in _Data ) {
      if ( ! jsx.Equal(_Data[Key], this.Data[Key]) ) {
        this.Data[Key] = _Data[Key];
        Changed[Key] = true;
        
        if ( Key == 'UserID' ) {
          O.Release(this.User);
          this.User = O.Get('User', _Data.UserID);
        }
      }
    }
    
    if ( ! jsx.Object.IsEmpty(Changed) )
      this.InvalidateViews({Data: Changed});
  },
  
  
  Destruct: function() {
    O.Release(this.User);
  },
  
  
  SetFileUpload: function( _$FileUpload ) {
    this.$FileUpload = _$FileUpload;
    
    var t = this;
    
    this.$FileUpload.fileUpload('option', {
      url: C_sBackEnd+'?Action=UploadFile',
      method: 'POST',
      //forceIframeUpload: true,
      
      initUpload: function(event, _aFiles, _Index, _Xhr, handler, _fnUpload) {
        t.aFiles.push(new CFile(_aFiles[_Index], _Xhr));
        t.InvalidateViews({FilesChanged: true});
        _fnUpload();
      },
      
      onLoad: function(event, files, index, _Xhr, handler) {
        var sResponse = GetFileUploadResponse(_Xhr);
        
        try {
          var Response = J.parseJSON(sResponse);
          var sText = Response ? Response.text : '';
          
          var File = t.aFiles.Find_V( function(_File){ return _File.Xhr == _Xhr; } );
          
          var Res = Response.js;
          if ( Res.Ok )
            File.SetUploadedFile(Res.File);
          else
            File.SetUploadErrors(Res.Errors);
        }
        catch ( Ex ) {
          var a = sResponse.match(/"text":"(.*?)"}$/);
          var sText = a[1];
        }
        
        if ( sText )
          ErrorConsoleWrite(sText);
      }
    });
  },
  
  
  Send: function( _sText ) {
        Console.Group('CMsg.Send');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.Res = null;
    this.bPending = true;
    
    if ( this.ID ) {
      this.sSendingText = _sText;
      
      this.InvalidateViews({Sending: true});
      
      this.Manager.ChangeMsg( this, _sText, [
        function( _Res ) {
              Console.Group("CMsg 'Change' success callback");
          
          if ( _Res === true ) {
            if ( this.sSendingText != this.Data.Text ) {
              this.Data.Text = this.sSendingText;
              this.InvalidateViews({Data: {Text: true}});
            }
            
            this.Res = true;
          }
          else
            this.Res = _Res.Errors || false;
          
              Console.GroupEnd();
        },
        function() {
              Console.Group("CMsg 'Change' complete callback");
          
          this.bPending = false;
          this.InvalidateViews({Sending: false});
          
              Console.GroupEnd();
        }]
      );
    }
    else {
      this.InvalidateViews({Sending: true});
      
      this.Manager.CreateMsg( _sText, [
        function( _Res ) {
              Console.Group("CMsg 'Create' success callback");
          
          this.Res = _Res.Ok ? true : _Res.Errors || false;
          
              Console.GroupEnd();
        },
        function() {
              Console.Group("CMsg 'Create' complete callback");
          
          this.bPending = false;
          this.InvalidateViews({Sending: false});
          
              Console.GroupEnd();
        }]
      );
    }
    
        Console.GroupEnd();
  },
  
  
  Delete: function() {
        Console.Group('CMsg.Delete');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.Res = null;
    this.bPending = true;
    
    this.InvalidateViews({Deleting: true});
    
    this.Manager.Delete( this, [
      function( _Res ) {
      },
      function() {
            Console.Group("CMsg 'Delete' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Deleting: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  }
}
jsx.Extend(CMsg, jsx.CModel);



function CMsgView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.EditView = null;
}
CMsgView.prototype = {
  OnModelAttach: function() {
    var t = this;
    var D = this.Model.Data;
    
    this.Fields = {
      CreateTimestamp: new CViewField(D, 'CreateTimestamp', this.DID,
                                      g_FieldEncoder_UnixTimestampToLocaleDateTime),
      Text: new CViewField(D, 'Text', this.DID, g_FieldEncoder_BBCodeToHtml,
                           false, false, RenderField_Html)
    }
  },
  
  
  Update_: function( _Hints ) {
        Console.Group('CMsgView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html(
        C_sTemplate_Msg.replace(/%ID%/gi, M.ID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.DeleteChildren();
      
      var UserView = new CUserView_Msg(this.DID+'User');
      O.GetWeak('User', D.UserID).AddView(UserView);
      this.AddChild(UserView);
      
      for ( var sField in this.Fields )
        this.Fields[sField].Update();
      
      var $Controls = J('#'+this.DID+'Controls');
      if ( D.CanEdit )
        $Controls.append(
          J('<a>', {id: this.DID+'EditTrigger', 'class': 'Control'}).text('Изменить')
            .click(function(){ t.Edit(); }) );
      if ( D.CanEdit && D.CanDelete )
        $Controls.append(' &sdot; ');
      if ( D.CanDelete )
        $Controls.append(
          J('<a>', {id: this.DID+'DeleteTrigger', 'class': 'Control'}).text('Удалить')
            .click(function(){ if ( confirm('Удалить сообщение?') ) M.Delete(); }) );
    }
    else {
      if ( _Hints.Sending ) {
        J('#'+this.DID+'DeleteTrigger').attr('disabled', true);
      }
      else if ( _Hints.Sending === false )
        if ( M.Res === true ) {
          J('#'+this.DID+'Edit').hide().empty();
          
          this.DeleteChild(this.EditView);
          this.EditView = null;
          
          J('#'+this.DID+'Text').show();
          J('#'+this.DID+'MsgBox').find('a.Control').removeAttr('disabled');
        }
        else {
          J('#'+this.DID+'DeleteTrigger').removeAttr('disabled');
        }
      
      if ( _Hints.Data ) {
        //var DocFields = this.FieldMap_Full.Get(_Hints.Data);
        for ( var sField in _Hints.Data )
          if ( this.Fields[sField] )
            this.Fields[sField].Update();
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  Edit: function() {
    var M = this.Model;
    
    if ( this.EditView || M.bPending )
      return;
    
    this.bEditing = true;
    this.bEditChange = false;
    
    J('#'+this.DID+'Text').hide();
    J('#'+this.DID+'Edit').show();
    
    this.EditView = new CMsgEditView(this.DID+'Edit', true);
    M.AddView(this.EditView);
    this.AddChild(this.EditView);
    
    J('#'+this.DID+'EditTrigger').attr('Disabled', true);
  },
  
  
  CancelEdit: function() {
    if ( this.Model.bPending )
      return;
    
    J('#'+this.DID+'Edit').hide().empty();
    
    this.DeleteChild(this.EditView);
    this.EditView = null;
    
    J('#'+this.DID+'Text').show();
    J('#'+this.DID+'EditTrigger').removeAttr('Disabled');
  }
}
jsx.Extend(CMsgView, jsx.CView);



function CMsgEditView( _DID, _bExistingMode ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  this.bExistingMode = Boolean(_bExistingMode);
  
  this.bEditChange = false;
}
CMsgEditView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgEditView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_MsgEdit
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      var $FileUpload = J('#'+this.DID+'FilesForm');
      $FileUpload.fileUpload();
      M.SetFileUpload($FileUpload);
      
      var $Tbl = J('#'+this.DID+'Files');
      for ( var i = 0, File; File = M.aFiles[i]; i++ ) {
        var DID = this.DID+'File'+i;
        
        $Tbl.append( J('<tr>', {id: DID}) );
        
        var View = new CFileView(DID);
        File.AddView(View);
        this.AddChild(View);
      }
      
      J('#'+this.DID+'SendTrigger').unbind('click').click(function(){ t._Send(); });
      if ( this.bExistingMode ) {
        J('#'+this.DID+'Textarea').val(M.Data.Text).keyup(function(){ t._OnKeyUp(this); }).focus();
        J('#'+this.DID+'CancelTrigger').show()
          .unbind('click').click(function(){ t.Parent.CancelEdit(); });
      }
    }
    else {
      if ( _Hints.FilesChanged ) {
        var $Tbl = J('#'+this.DID+'Files');
        
        for ( var i = this.aChildren.length, File; File = M.aFiles[i]; i++ ) {
          var DID = this.DID+'File'+i;
          
          $Tbl.append( J('<tr>', {id: DID}) );
          
          var View = new CFileView(DID);
          File.AddView(View);
          this.AddChild(View);
        }
      }
      
      if ( _Hints.Sending ) {
        HideErrorMsg(this.DID);
        J('#'+this.DID+'ChangeIndicator').hide();
        J('#'+this.DID+'SendWait').show();
        J('#'+this.DID+'Textarea, #'+this.DID+'SendTrigger, #'+this.DID+'CancelTrigger')
          .attr('disabled', true);
      }
      else if ( _Hints.Sending === false && M.Res !== true ) {
        ShowErrorMsg(this.DID, M.Res ? M.Res : 'Ошибка');
        J('#'+this.DID+'SendWait').hide();
        J('#'+this.DID+'ChangeIndicator').show();
        J('#'+this.DID+'Textarea, #'+this.DID+'SendTrigger, #'+this.DID+'CancelTrigger')
          .removeAttr('disabled');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  InsertImage: function( _sFileName ) {
    InsertTextAtCursor(J('#'+this.DID+'Textarea').get(0), '[img]'+_sFileName+'[/img]');
  },
  
  
  _OnKeyUp: function( _El ) {
    var bEditChange = J(_El).val() != this.Model.Data.Text;
    
    if ( bEditChange != this.bEditChange ) {
      J('#'+this.DID+'ChangeIndicator').toggle();
      this.bEditChange = bEditChange;
    }
  },
  
  
  _Send: function() {
    this.Model.Send( J('#'+this.DID+'Textarea').val() );
  }
}
jsx.Extend(CMsgEditView, jsx.CView);



function CFile( _LocalFile, _Xhr ) {
  jsx.CModel.call(this);
  
  this.Local = _LocalFile;
  this.Xhr = _Xhr;
  this.Uploaded = null;
  this.UploadErrors = null;
}

CFile.prototype = {
  sClass: 'File',
  
  SetUploadedFile: function( _File ) {
    this.Uploaded = _File;
    
    this.InvalidateViews({Uploaded: true});
  },
  
  SetUploadErrors: function( _Errors ) {
    this.UploadErrors = _Errors || false;
    
    this.InvalidateViews({Uploaded: false});
  }
}
jsx.Extend(CFile, jsx.CModel);



function CFileView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}
CFileView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CFileView.Update_');
    
    var t = this;
    var M = this.Model;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_File
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      if ( M.Uploaded ) {
        J('#'+this.DID+'Name').text(M.Uploaded.Name);
        J('#'+this.DID+'Size').text(M.Uploaded.Size);
        J('#'+this.DID+'InsertTrigger').show()
          .click(function(){ t.Parent.InsertImage(M.Uploaded.Name); });
      }
      else {
        J('#'+this.DID+'Name').text(M.Local.name);
        J('#'+this.DID+'Size').text(M.Local.size != null ? M.Local.size : '');
        
        if ( M.UploadErrors == null )
          J('#'+this.DID+'Wait').show();
        else
          ShowErrorMsg(this.DID, M.UploadErrors ? M.UploadErrors : 'Ошибка');
      }
    }
    else {
      J('#'+this.DID+'Wait').hide();
      
      if ( _Hints.Uploaded ) {
        J('#'+this.DID+'Name').text(M.Uploaded.Name);
        J('#'+this.DID+'Size').text(M.Uploaded.Size);
        J('#'+this.DID+'InsertTrigger').show()
          .click(function(){ t.Parent.InsertImage(M.Uploaded.Name); });
      }
      else if ( _Hints.Uploaded === false) {
        ShowErrorMsg(this.DID, M.UploadErrors ? M.UploadErrors : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  }
}
jsx.Extend(CFileView, jsx.CView);



function CUser() {
  jsx.CModel.call(this);
  
  this.Data = {};
}

CUser.prototype = {
  sClass: 'User'
}
jsx.Extend(CUser, jsx.CModel);



function CUserView_Msg( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}
CUserView_Msg.prototype = {
  OnModelAttach: function() {
    var D = this.Model.Data;
    
    this.Fields = {
      Login: new CViewField(D, 'Login', this.DID),
      Group: new CViewField_Proxy([this, this.RenderGroup])
    }
  },
  
  
  Update_: function( _Hints ) {
        Console.Group('CUserView_Msg.Update_');
    
    for ( var sField in this.Fields )
      this.Fields[sField].Update();
    
        Console.GroupEnd();
    return true;
  },
  
  
  RenderGroup: function() {
    var D = this.Model.Data;
    var $El = J('#'+this.DID+'Group');
    
    if ( D.Group == UserGroup_Admin )
      $El.text('Администратор').addClass('Admin').show();
    else
      $El.hide().empty().removeClass('Admin');
  }
}
jsx.Extend(CUserView_Msg, jsx.CView);

<?php } ?>

//]]>
</script>

</head>

<body onLoad="Init()">
  <div id="ErrorConsole"
       style="border:1px solid silver; background-color:#FFFFC0; font-size:11px; display:none;">
    <div style='float:right'>
      <a class='Clickable' onClick='J("#ErrorConsoleText").empty()'>Очистить</a>
      <a class='Clickable' onClick='J("#ErrorConsole").hide()'>Закрыть</a>
    </div>
    <div id="ErrorConsoleText" style="padding:7px"></div>
  </div>
  
<?php if ( $bAdminMode ) { ?>
  <br />
  
  <div id='A_Main'>
    <div>
      <div style='position:relative'>
        <img src='?img=logo_softline.png' style='position:absolute' />
      </div>
      <div style='text-align:center'>
        <div style='font-size:2em; font-weight:bold;'>Гостевая книга - Панель управления</div>
        <div>Хованский А. О.</div>
      </div>
    </div>
    <hr />
    
    <div id='A_Contents'></div>
  
    <br />
    <hr />
    <div style='font-size:11px; text-align: right'>Хованский А. О.</div>
    <br />
  </div>
<?php } else { ?>
  <div id="Main"></div>
<?php } ?>
</body>
</html>

<?php
}
else {
////////////////////////////////////////////////////////////////////////////////////////////////////
// back-end

if ( $bAdminMode ) {
  $config = array();
  $DB = null;
  $g_User = null;
  
  $g_Installer = new CInstaller;
  $g_Installer->CheckInstall();
}



function DoAction( $_sAction, $_aRequestData )
{
  global $config, $DB, $g_User, $g_iUserID, $g_PacketQueryContextValue;
  
  if ( ! HasRight($g_User, '', $_sAction) )
    throw new CException_Unauthorized($_sAction);

	switch ($_sAction) {
    case 'GetMsgs': {
      global $config, $g_User, $g_iUserID;
      
      
      $iNumOnPage = isset($config['NumMsgsOnPage']) ? (int) $config['NumMsgsOnPage'] : 10;
      
      if ( isset($_aRequestData['Offset']) ) {
        $iOffset = (int) $_aRequestData['Offset'];
        $iCount = isset($_aRequestData['Count']) ? (int) $_aRequestData['Count'] : $iNumOnPage;
      }
      else {
        $Page = $_aRequestData['Page'];
        
        if ( isset($Page['Num']) ) {
          $iOffset = ($Page['Num'] - 1) * $iNumOnPage;
          $iCount = $iNumOnPage;
        }
        elseif ( isset($Page['Containing']) ) {
          $iMsgID = (int) $Page['Containing'];
          $aIDs = $DB->FetchArray("SELECT ID FROM messages ORDER BY CreateTimestamp");
          $i = array_search($iMsgID, $aIDs);
          
          if ( $i !== false ) {
            $iPageNum_Return = floor($i / $iNumOnPage) + 1;
            $iOffset = ($iPageNum_Return - 1) * $iNumOnPage;
            $iCount = $iNumOnPage;
          }
          else
            $Return['Errors'][] = "Сообщение [ID=$iMsgID] не найдено";
        }
      }
      
      if ( ! isset($Return['Errors']) ) {
        $Return['TotalCount'] = $Count = $DB->FetchValue("SELECT count(*) FROM messages", true);
        
        $sCols = CMsg::DBColumns_S();
        
        $aRows = $DB->FetchRowset(
          "SELECT $sCols FROM messages ORDER BY CreateTimestamp LIMIT $iOffset, $iCount");
        
        if ( ! $aRows ) {
          if ( $Count ) {
            $iPageNum_Return = ceil($Count / $iNumOnPage);
            $iOffset = ($iPageNum_Return - 1) * $iNumOnPage;
            $iCount = $iNumOnPage;
            
            $aRows = $DB->FetchRowset(
              "SELECT $sCols FROM messages ORDER BY CreateTimestamp LIMIT $iOffset, $iCount");
          }
          else
            $iPageNum_Return = 1;
        }
        
        $aMsgs = CMsg::Get_Rowset($aRows);
        
        $bEdit = HasRight($g_User, '', 'EditOthersMsgs');
        $bDel = HasRight($g_User, '', 'DeleteOthersMsgs');
        
        $iLast = $Count - $iOffset - 1;
        for ( $i = 0; $i < count($aMsgs); $i++ ) {
          $raMsg =& $aMsgs[$i];
          $raMsg['CanEdit'] = $g_User && $raMsg['UserID'] == $g_iUserID || $bEdit;
          $raMsg['CanDelete'] = $g_User && $raMsg['UserID'] == $g_iUserID && $i == $iLast || $bDel;
        }
        
        $Return['Msgs'] = $aMsgs;
        
        if ( $aMsgs )
          $Return['Users'] = CUser::Get_IDs( CTable::S_GetColumn($aMsgs, 'UserID') );
        
        if ( isset($iPageNum_Return) )
          $Return['PageNum'] = $iPageNum_Return;
        
        $Return['Ok'] = true;
      }
    }
    break;

		case 'PostMsg': {
      $sText = isset($_aRequestData['Text']) ? $_aRequestData['Text'] : null;
      //$aAttachs = isset($_aRequestData['Attachs']) ? $_aRequestData['Attachs'] : null;
			
			$Msg = new CMsg;
      $Msg->UserID = $g_iUserID;
      $Msg->CreateTimestamp = $Msg->LastEditTimestamp = time();
      $Msg->Text = $sText;
			
			$Return['ID'] = $g_PacketQueryContextValue = $Msg->Save($DB);
			$Return['Ok'] = true;
		}
		break;

    case 'ChangeMsg': {
			$iID = isset($_aRequestData['ID']) ? (int) $_aRequestData['ID'] : null;
      $sText = isset($_aRequestData['Text']) ? $_aRequestData['Text'] : null;
      
      $Msg = new CMsg($iID, $DB);
      $Msg->SetSaveField('Text', $sText);
      
      $Return = true;
    }
    break;

		case 'DeleteMsg': {
			$iID = isset($_aRequestData['ID']) ? (int) $_aRequestData['ID'] : null;
			
			$a = $DB->FetchRow("SELECT UserID FROM messages WHERE ID=$iID");
			if ( $a ) {
				if ( ! HasRight($g_User, '', 'DeleteOthersMsgs') ) {
					if ( $a['UserID'] != $g_iUserID )
						throw new ErrorException("Нет права на удаление чужих сообщений", 0, 0);
					
					$LastID = $DB->FetchValue(
						"SELECT ID FROM messages ORDER BY CreateTimestamp DESC LIMIT 1");
					if ( $LastID === false )
						$Return['Errors'][] = "Сообщение [ID=$iID] не найдено";
					elseif ( $LastID != $iID )
						$Return['Errors'][] =
							"Вы не можете удалить это сообщение, так как после него появились новые";
				}
			}
			else
				$Return['Errors'][] = "Сообщение [ID=$iID] не найдено";
			
			if ( ! isset($Return['Errors']) ) {
				$DB->Query("DELETE FROM messages WHERE ID=$iID");
				
				$Return = true;
			}
		}
		break;



		case 'Register': {
			$sLogin = isset($_aRequestData['Login']) ? $_aRequestData['Login'] : null;
			$sPassword = isset($_aRequestData['Password']) ? $_aRequestData['Password'] : null;
			
			if ( ! CUser::Valid('Login', $sLogin) )
				$Return['Errors'][] = "Недопустимое значение логина";
			if ( ! CUser::Valid('Password', $sPassword) )
				$Return['Errors'][] = "Недопустимое значение пароля";
			
			if ( ! isset($Return['Errors']) )
        if ( $User = CUser::GetByLogin($sLogin) )
          $Return['Errors'][] = "Логин занят";
				
			if ( ! isset($Return['Errors']) ) {
        $User = new CUser();
        $User->Login = $sLogin;
        $User->Password = $sPassword;
        $User->Group = CUser::User;
        
        $g_iUserID = $User->Save($DB);
        
        $_SESSION['Login'] = $sLogin;
        $_SESSION['Password'] = $sPassword;
        
        $g_User = $User;
        
        $Return['UserGroup'] = $User->Group;
        $Return['Ok'] = true;
      }
		}
		break;

		case 'LogIn': {
			$sLogin = isset($_aRequestData['Login']) ? $_aRequestData['Login'] : null;
			$sPassword = isset($_aRequestData['Password']) ? $_aRequestData['Password'] : null;
			
			if ( $User = CUser::GetByLogin($sLogin) ) {
				if ( md5($sPassword) == $User->Password ) {
					$_SESSION['Login'] = $sLogin;
					$_SESSION['Password'] = $sPassword;
					
					$g_User = $User;
          $g_iUserID = $g_User->ID;
					
					$Return['UserGroup'] = $User->Group;
					$Return['Ok'] = true;
				}
				else
					$Return['Errors'][] = "Неверный пароль";
			}
			else
				$Return['Errors'][] = "Пользователь не найден";
		}
		break;

		case 'LogOut': {
			unset($_SESSION['Login']);
			unset($_SESSION['Password']);
			
      $g_User = CUser::Get('guest', 'guest');
      $g_iUserID = $g_User->ID;
      
			$Return['Ok'] = true;
		}
		break;



    case 'UploadFile': {
      if ( ! isset($_FILES['file']) )
        throw new ErrorException('UploadFile: ! isset($_FILES[\'file\'])', 0, 0);
      
      $aFile = $_FILES['file'];
      
      if ( $aFile['error'] != UPLOAD_ERR_OK ) {
        $Return['Errors'][] = "Ошибка загрузки файла: #$aFile[error]";
        return $Return;
      }
      
      $sExt = pathinfo($aFile['name'], PATHINFO_EXTENSION);
      
      if ( ! in_array( $sExt, array('jpg', 'jpeg', 'png', 'gif', 'bmp') ) ) {
        $Return['Errors'][] = "Недопустимое расширение файла";
        return $Return;
      }
      
      mb_substitute_character(0x5F); // '_'
      $sNewNameBase_FS = FSCompatible( FSEncode(pathinfo($aFile['name'], PATHINFO_FILENAME)) );
      $sNewName_FS = $sNewNameBase_FS.".$sExt";
      for ( $i = 0; $i <= 5; $i++ ) {
        $sNewPath_FS = 'files/'.$sNewName_FS;
        
        if ( ! file_exists($sNewPath_FS) )
          break;
        
        if ( $i == 5 )
          throw new ErrorException('Не удалось закодировать имя файла', 0, 0);
        
        $sNewName_FS = $sNewNameBase_FS.'_'.xs_MakeRandomStr(5).".$sExt";
      }
      
      if ( ! move_uploaded_file($aFile['tmp_name'], $sNewPath_FS) ) {
        $Return['Errors'][] = "Неизвестная ошибка";
        return $Return;
      }
      
      $sNewName = FSDecode($sNewName_FS);
      
      //$DB->Query("INSERT INTO attachments". $DB->BuildArray('INSERT', array(
      //             'StoredName' => $sNewName,
      //             'OriginalName' => $aFile['name'],
      //             'Size' => $aFile['size'] )));
      
      $Return['File'] = array(/*'ID' => $DB->InsertID(),*/
                              'Name' => $sNewName,
                              'Size' => $aFile['size']);
      $Return['Ok'] = true;
    }
    break;
	}
  
  return isset($Return) ? $Return : null;
}



function CallMethod( $_aRequestData )
{
  global $DB, $g_User;
  
  $sClass = $_aRequestData['Class'];
  $ID = isset($_aRequestData['ID']) ? $_aRequestData['ID'] : null;
  $sMethod = $_aRequestData['Method'];
  $aArgs = isset($_aRequestData['Args']) ? $_aRequestData['Args'] : array();
  
  //if ( ! HasRight($g_User, $sClass, $sMethod) ) {
  //  throw new CException_Unauthorized("$sClass::$sMethod");
  //}
  
  switch ( $sClass ) {
    case 'Installer': {
			global $g_Installer;
      
			return call_user_func_array(array($g_Installer, $sMethod), $aArgs);
		}
  }
}

//

function ReplacePacketQueryContextValue( &$_rv, $_i ) {
  global $g_PacketQueryContextValue;
  
  if ( $_rv == C_sPacketQueryContextValue )
    $_rv = $g_PacketQueryContextValue;
}



function FSEncode( $_s ) {
  global $config;
  return mb_convert_encoding($_s, $config['FileSystemEncoding']);
}
function FSDecode( $_s ) {
  global $config;
  return mb_convert_encoding($_s, 'UTF-8', $config['FileSystemEncoding']);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

if ( ! $bAdminMode )
  $g_iUserID = $g_User->ID;


$sAction = $_REQUEST['Action'];

try {
  switch ( $sAction ) {
    case 'PacketQuery':
      $g_PacketQueryContextValue = null;
      
      foreach ( $_RequestData as $aRequest ) {
        if ( isset($g_PacketQueryContextValue) ) {
          array_walk_recursive($aRequest, 'ReplacePacketQueryContextValue');
          $g_PacketQueryContextValue = null;
        }
        
        try {
          $Res = isset($aRequest['Action']) ?
            DoAction($aRequest['Action'],
                     isset($aRequest['Data']) ? $aRequest['Data'] : array()) :
            CallMethod($aRequest);
          
          $bOk = is_array($Res) ? (isset($Res['Ok']) ? $Res['Ok'] : false) : (
                 is_bool($Res) ? $Res :
                 false );
        }
        catch ( Exception $e ) {
          $Res = array();
          $Res['Errors'][] = HasRight($g_User, '', 'ExtendedErrorInfo') ?
                             (string) $e : $e->getMessage();
          $bOk = false;
        }
        
        $_RESULT['Data'][] = $Res;
        
        if ( ! $bOk && isset($aRequest['AbortOnFail']) && $aRequest['AbortOnFail'] )
          break;
      }
    break;
    
    case 'CallMethod':
      $_RESULT = CallMethod($_RequestData);
    break;
    
    default:
      $_RESULT = DoAction($sAction, $_RequestData);
  }
}
catch ( Exception $e ) {
  $_RESULT['Errors'][] = HasRight($g_User, '', 'ExtendedErrorInfo') ?
                         (string) $e : $e->getMessage();
}

if ( DEBUG )
	error_log( var_export($_RESULT, true) ."\n\n", 3, 'logs/_RESULT.txt' );

} // back-end

?>