<?php

function yetisum ($number)
{
	$mag = 0;
	if (is_numeric($number)) {
		$mag = $number;
		$mag = ceil($mag);
	}
	if ($mag >= 1000) {
		$num_str = number_format($mag, 0, ",", " ");
	} else {
		$num_str = number_format($mag);
	}
	$num_str .= "&#8381;";
	return $num_str;
}
?>
