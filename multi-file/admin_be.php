<?php

define('DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_cache_limiter('nocache');
//session_set_cookie_params(14*24*60*60);
session_start();

define('ROOT', '');

require_once "include/Installer.php";

//require_once "include/Log.php";
//$Log = new CLog('logs/admin.log');


if ( ! defined('C_sPacketQueryContextValue') )
  define('C_sPacketQueryContextValue', '_PacketQueryContextValue_');


mb_internal_encoding('UTF-8');


$_RequestData = json_decode(file_get_contents('php://input'), true);
if ( DEBUG )
  error_log( $_REQUEST["Action"]."\n". var_export($_RequestData, true) ."\n\n", 3, 'logs/admin _REQUEST.txt' );


require_once "jshttprequest/JsHttpRequest.php";
$JsHttpRequest = new JsHttpRequest('UTF-8');


$config = array();
$DB = null;
$g_User = null;

$g_Installer = new CInstaller;
$g_Installer->CheckInstall();


$sAction = $_REQUEST["Action"];

try {
  switch ( $sAction ) {
    // Query combined from several queries.
    // Context value is the outcome of first query (if it has one), e.g. ID of object created by the server.
    // Subsequent queries can use the context value, e.g. to read created object.
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
	error_log( var_export($_RESULT, true) ."\n\n", 3, 'logs/admin _RESULT.txt' );



/*
 * Perform model service call.
 */
function DoAction( $_sAction, $_aRequestData )
{
  global $config, $DB, $g_User, $g_iUserID, $g_PacketQueryContextValue;
  
  if ( ! HasRight($g_User, '', $_sAction) )
    throw new CException_Unauthorized($_sAction);
  
	switch ($_sAction) {
	}
  
  return isset($Return) ? $Return : null;
}



/*
 * Call object method.
 */
function CallMethod( $_aRequestData )
{
  global $DB, $g_User;
  
  $sClass = $_aRequestData['Class'];
  $ID = isset($_aRequestData['ID']) ? $_aRequestData['ID'] : null;
  $sMethod = $_aRequestData['Method'];
  $aArgs = isset($_aRequestData['Args']) ? $_aRequestData['Args'] : array();
  
  //if ( ! getRights($sClass, $sMethod, $g_User) ) {
  //  throw new CException_Unauthorized('$sClass::$sMethod');
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

?>
