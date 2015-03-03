<?php

require_once "Util.php";



class CString
{
  function EscapeForScript( $_s ) {
    return str_replace(array("\r", "\n", '"'), array('\r', '\n', '\"'), $_s);
  }
}



function FSCompatible( $_s )
{
  static $a1 = array('?',':','"','*','\\','|','/','<','>');
  static $a2 = array('7','=',"'",'_','_' ,'_','~','‹','›');
  
  return str_replace( $a1, $a2, $_s );
}

?>
