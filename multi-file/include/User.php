<?php

require_once "DBClass.php";



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

?>