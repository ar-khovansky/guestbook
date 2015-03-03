<?php

define('DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_cache_limiter('nocache');
//session_set_cookie_params(14*24*60*60);
session_start();

define('ROOT', '');

require_once "include/Installer.php";
require_once "include/XSLib/String.php";


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

<title><?php echo (isset($config['SiteTitle']) ?
                     $config['SiteTitle'] : CInstaller::$aDefaultConfig['SiteTitle']) .
                  ' - Панель управления'; ?></title>

<link rel="stylesheet" href="<?php echo "$sTemplateDir/styles.css" ?>">

<script src="js/jquery-1.5.2.js"></script>
<script src="js/jquery.json-2.2.js"></script>

<script>
//<![CDATA[
  var C_sBackEnd = 'admin_be.php';
  
  var C_sPacketQueryContextValue =
    '<?php echo defined('C_sPacketQueryContextValue') ?
             C_sPacketQueryContextValue : '_PacketQueryContextValue_'; ?>';
  
  var C_GeneralTimeout =
    <?php echo (isset($config['GeneralTimeout']) ? $config['GeneralTimeout'] : 30) * 1000; ?>;
  
  var C_sTemplateDir = "<?php echo "$sTemplateDir/"; ?>";
  var C_sImagesPrefix = C_sTemplateDir+'images/';
  var C_sTemplate_A_Install = "<?php echo GetTemplate('A_Install'); ?>";
  var C_sTemplate_A_Config = "<?php echo GetTemplate('A_Config'); ?>";
  
  var ValidationRules_Login = <?php echo json_encode(CUser::ValidationRules('Login')); ?>;
  
  //var sInitErrors = '<php echo $sErrors; ?>';
//]]>
</script>

<script src="js/jsx.js" charset="UTF-8"></script>
<script src="js/common.js" charset="UTF-8"></script>
<script src="js/admin.js" charset="UTF-8"></script>

</head>

<body onLoad='Init()'>
  <div id="ErrorConsole"
       style="border:1px solid silver; background-color:#FFFFC0; font-size:11px; display:none;">
    <div style='float:right'>
      <a class='Clickable' onClick='J("#ErrorConsoleText").empty()'>Очистить</a>
      <a class='Clickable' onClick='J("#ErrorConsole").hide()'>Закрыть</a>
    </div>
    <div id="ErrorConsoleText" style="padding:7px"></div>
  </div>
  
  <br />
  
  <div id='A_Main'>
    <div>
      <div style='position:relative'>
        <img src='<?php echo "$sTemplateDir/"; ?>images/logo_softline.png' style='position:absolute' />
      </div>
      <div style='text-align:center'>
        <div style='font-size:2em; font-weight:bold;'>Гостевая книга</div>
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
</body>
</html>
