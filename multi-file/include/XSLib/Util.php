<?php

function xs_MakeRandomStr( $len = 10 ) {
	$str = '';
	while ( strlen($str) < $len )
		$str .= str_shuffle(preg_replace('#[^0-9a-zA-Z]#', '', crypt(uniqid(mt_rand(), true))));
	return substr($str, 0, $len);
}

?>
