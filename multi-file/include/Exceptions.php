<?php

class CException_Unauthorized extends ErrorException
{
  function __construct( $sOperation, $File = null, $Line = null ) {
    parent::__construct("Нет права на выполнение операции '$sOperation'",
                        0, 0, $File, $Line);
  }
}

?>