<?php

define('DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_cache_limiter('nocache');
//session_set_cookie_params(14*24*60*60);
session_start();

define('ROOT', '');

require_once "config.php";
require_once "include/Installer.php";
require_once "include/MySQL.php";
require_once "include/User.php";
require_once "include/XSLib/String.php";


$sErrors = '';


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

if ( ! $g_User )
  $sErrors .= 'Ошибка: не найден гостевой аккаунт. Возможно, приложение не установлено.\n';


$sTemplateDir = 'templates/'.(isset($config['Template']) ?
                              $config['Template'] : CInstaller::$aDefaultConfig['Template']);

function GetTemplate( $_s ) {
  global $sTemplateDir;
  return CString::EscapeForScript(file_get_contents("$sTemplateDir/$_s.htm"));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo isset($config['SiteTitle']) ?
                  $config['SiteTitle'] : CInstaller::$aDefaultConfig['SiteTitle']; ?></title>

<link rel="stylesheet" href="<?php echo "$sTemplateDir/styles.css" ?>">

<script src="js/jquery-1.5.2.js"></script>
<script src="js/jquery.json-2.2.js"></script>
<script src="js/jquery.fileupload.js"></script>

<script>
//<![CDATA[
  var C_sBackEnd = 'client_be.php';
  
  var C_sPacketQueryContextValue =
    '<?php echo defined('C_sPacketQueryContextValue') ?
             C_sPacketQueryContextValue : '_PacketQueryContextValue_'; ?>';
  
  var C_GeneralTimeout =
    <?php echo (isset($config['GeneralTimeout']) ? $config['GeneralTimeout'] : 30) * 1000; ?>;
  
  var C_sTemplateDir = "<?php echo "$sTemplateDir/"; ?>";
  var C_sImagesPrefix = C_sTemplateDir+'images/';
  var C_sTemplate_Main = "<?php echo GetTemplate('Main'); ?>";
  var C_sTemplate_Register = "<?php echo GetTemplate('Register'); ?>";
  var C_sTemplate_Msg = "<?php echo GetTemplate('Msg'); ?>";
  var C_sTemplate_MsgEdit = "<?php echo GetTemplate('MsgEdit'); ?>";
  var C_sTemplate_File = "<?php echo GetTemplate('File'); ?>";
  
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
//]]>
</script>

<script src="js/jsx.js" charset="UTF-8"></script>
<script src="js/common.js" charset="UTF-8"></script>
<script src="js/client.js" charset="UTF-8"></script>

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
  
  <div id="Main"></div>
</body>
</html>
