<?php

define('DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_cache_limiter('nocache');
//session_set_cookie_params(14*24*60*60);
session_start();

define('ROOT', '');

require_once "config.php";
require_once "include/MySQL.php";
require_once "include/User.php";
require_once "include/Exceptions.php";
require_once "rights.php";

//require_once "include/Log.php";
//$Log = new CLog('logs/client.log');


if ( ! defined('C_sPacketQueryContextValue') )
  define('C_sPacketQueryContextValue', '_PacketQueryContextValue_');


mb_internal_encoding('UTF-8');


$_RequestData = json_decode(file_get_contents('php://input'), true);
if ( DEBUG ) {
  error_log( $_REQUEST['Action']."\n". var_export($_RequestData, true) ."\n\n",
             3, 'logs/client _REQUEST.txt' );
  error_log( var_export($_FILES, true) ."\n", 3, 'logs/client _REQUEST.txt' );
  error_log( var_export($_SERVER, true) ."\n", 3, 'logs/client _REQUEST.txt' );
  error_log( var_export($_REQUEST, true) ."\n", 3, 'logs/client _REQUEST.txt' );
  error_log( "----------\n\n", 3, 'logs/client _REQUEST.txt' );
}


require_once "jshttprequest/JsHttpRequest.php";
$JsHttpRequest = new JsHttpRequest("UTF-8");


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

//if ( ! $g_User )
//  $sErrors .= 'Ошибка: пользователь guest не найден. Возможно, приложение не установлено.\n';

$g_iUserID = $g_User->ID;


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
	error_log( var_export($_RESULT, true) ."\n\n", 3, 'logs/client _RESULT.txt' );



/*
 * Perform model service call.
 */
function DoAction( $_sAction, $_aRequestData )
{
  global $config, $DB, $g_User, $g_iUserID, $g_PacketQueryContextValue;
  
  if ( ! HasRight($g_User, '', $_sAction) )
    throw new CException_Unauthorized($_sAction);

	switch ($_sAction) {
    // Get messages
    case 'GetMsgs': {
      require_once "include/Msg.php";
      require_once "include/XSLib/Array.php";
      
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


		// Post message
		case 'PostMsg': {
      require_once "include/Msg.php";
			
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


    // Update message
    case 'ChangeMsg': {
      require_once "include/Msg.php";
			
			$iID = isset($_aRequestData['ID']) ? (int) $_aRequestData['ID'] : null;
      $sText = isset($_aRequestData['Text']) ? $_aRequestData['Text'] : null;
      
      $Msg = new CMsg($iID, $DB);
      $Msg->SetSaveField('Text', $sText);
      
      $Return = true;
    }
    break;


		// Delete message
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



		// Register user
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


		// Log user in
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


		// Log user out
		case 'LogOut': {
			unset($_SESSION['Login']);
			unset($_SESSION['Password']);
			
      $g_User = CUser::Get('guest', 'guest');
      $g_iUserID = $g_User->ID;
      
			$Return['Ok'] = true;
		}
		break;



    case 'UploadFile': {
      require_once "include/XSLib/String.php";
      require_once "include/XSLib/Util.php";
      
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
  
  if ( ! HasRight($g_User, $sClass, $sMethod) ) {
    throw new CException_Unauthorized("$sClass::$sMethod");
  }
  
  switch ( $sClass ) {
    //case 'Msg':
    //  require_once "include/Msg.php";
    //  
    //  $Msg = new CMsg($ID, $DB);
    //  
    //  return call_user_func_array(array($Msg, $sMethod), $aArgs);
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

?>
