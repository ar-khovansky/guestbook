<?php

require_once "DBClass.php";



/*
 * Guestbook message (post).
 */
class CMsg extends CDBClass
{
  protected static $aFields = array(
    'ID' => array('Type' => 'i'),
    'UserID' => array('Type' => 'i'),
    'CreateTimestamp' => array('Type' => 'i'),
    'LastEditTimestamp' => array('Type' => 'i'),
    'Text' => array('Type' => 's')
  );
  
  protected static $sTable = 'messages';
  
  //
  
  public function SetSaveField( $_sField, $_Val ) {
    global $g_User;
    
    if ( ! in_array($_sField, array('Text')) )
      throw new ErrorException(__FUNCTION__.": Invalid field: $_sField", 0, 0);
    
    $this->LoadField('UserID');
    
    if ( ! ($g_User && $this->aData['UserID'] == $g_User->ID ||
						HasRight($g_User, '', 'EditOthersMsgs')) )
      throw new CException_Unauthorized(__FUNCTION__);
    
    $_Val = static::Validate($_sField, $_Val);
		
		$this->SaveDBField($_sField, $_Val);
    
    return true;
  }
}

CMsg::InitStatic();

?>