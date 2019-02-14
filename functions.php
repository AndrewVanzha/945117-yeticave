<?php

/**
* Функция принимает два аргумента: имя файла шаблона 
* и ассоциативный массив с данными для этого шаблона.
* Функция возвращает строку — итоговый HTML-код с подставленными данными.
*
*/
function include_template($name, $data) {
  $name = 'templates/' . $name;
  $result = '';

  if (!is_readable($name)) {
    return $result;
  }

  ob_start();
  $ex = extract($data);
  require $name;

  $result = ob_get_clean();

  return $result;
}

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
	$num_str .= " &#8381;";
	return $num_str;
}
?>
