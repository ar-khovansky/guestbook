<?php

class CArray
{
  static function S_Merge( &$t_ra, $_a ) {
    $t_ra = array_merge($t_ra, $_a);
  }
}



class CTable
{
	static function S_GetColumn( $_a, $_sCol )
	{
		$a = array();
		foreach ( $_a as $aRow )
			$a[] = $aRow[$_sCol];
		return $a;
	}
}

?>
