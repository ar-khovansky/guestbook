<?php

/*
 * Base class for objects persisted in database. Provides validation and persistence.
 *
 * Such object stores its fields in array ($aData). Fields have declarative descriptions,
 * stored in static array $aFields in child classes. Desription specifies field type, range of
 * valid values, DB column name etc.
 */
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

?>