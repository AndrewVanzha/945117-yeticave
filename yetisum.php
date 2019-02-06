<?php

/**
* Выводит округленную сумму с пробелом-разделителем и символом рубля
*
* @param int $number
*
* @return string
*/
function yetisum ($number)
{
	$value = 0;
	if (is_numeric($number)) {
		$value = ceil($number);
	}
	$num_str = number_format($value, 0, ",", " ");
	$num_str .= "&#8381;";
	return $num_str;
}
?>
