<?php

class CConfigFile
{
  protected $sFile;
  
  protected $sText = '';
  
  //
  
  public function __construct( $_sFile ) {
    $this->sFile = $_sFile;
  }
  
  
  public function AddLine( $_s ) {
    $this->sText .= $_s."\n";
  }
  
  
  public function AddParams( $_sVariableName, $_aParams ) {
    $sPrefix = '$'.$_sVariableName;
    foreach ( $_aParams as $k => $v )
      $this->sText .= $this->Encode($sPrefix, $k, $v, true);
  }
  
  
  public function Write() {
    if ( ! file_put_contents($this->sFile, "<?php\n\n$this->sText?>") )
      throw new ErrorException("Ошибка записи в файл \"$this->sFile\"", 0, 0);
  }
  
  //
  
  protected function Encode( $_sPrefix, $_Name, $_Val, $_bInsertEmptyLine = false ) {
    if ( is_array($_Val) ) {
      $_sPrefix .= "['$_Name']";
      foreach ( $_Val as $k => $v )
        $this->sText .= $this->Encode($_sPrefix, $k, $v);
      $this->sText .= "\n";
    }
    else {
      if ( is_string($_Val) )
        $_Val = "'$_Val'";
      return $_sPrefix."['$_Name'] = $_Val;\n" . ($_bInsertEmptyLine ? "\n" : '');
    }
  }
}

?>