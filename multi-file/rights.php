<?php

require_once "include/User.php";



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

?>