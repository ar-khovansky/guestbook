<?php

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



function str_compact ($str)
{
	return preg_replace('#\s+#', ' ', trim($str));
}



function LogMsg($msg, $file_name)
{
	if (is_array($msg))
		$msg = join(LOG_LF, $msg);
	error_log( $msg, 3, $file_name );
}



