<?php

require_once "MySQL.php";
require_once "User.php";
require_once "Exceptions.php";



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
    require_once ROOT."include/XSLib/Array.php";

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
    require_once "ConfigFile.php";
    
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
    require_once "ConfigFile.php";
    
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

?>