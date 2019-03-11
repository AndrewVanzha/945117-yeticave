<?php

$is_auth = rand(0, 1); /* случайная переменная */
$user_name = 'Андрей Ванжа'; /* имя для регистрации */

/**
* Функция принимает два аргумента: имя файла шаблона 
* и ассоциативный массив с данными для этого шаблона.
* Функция возвращает строку — итоговый HTML-код с подставленными данными.
*
*/
function include_template($name, $data) {
/*  print($name.'<br>');
  if ($name == 'add_lot.php') {
    var_dump($data);
    print(' data<br>');
    print($data['field_errors']['lot-step'].' 1 <br>');
    print($field_errors['lot-step'].' 2 <br>');
    print($data['field_errors'].' 3 <br>');
    foreach ($data as $key=>$dva) {
      print_r($dva);
      print(' dva '.$key.'<br>');
    }
  }
*/
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
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {

  $stmt = mysqli_prepare($link, $sql);

  if ($data) {
      $types = '';
      $stmt_data = [];

      foreach ($data as $value) {
          $type = null;

          if (is_int($value)) {
              $type = 'i';
          }
          else if (is_string($value)) {
              $type = 's';
          }
          else if (is_double($value)) {
              $type = 'd';
          }

          if ($type) {
              $types .= $type;
              $stmt_data[] = $value;
          }
      }

      $values = array_merge([$stmt, $types], $stmt_data);

      $func = 'mysqli_stmt_bind_param';
      $func(...$values);
  }

  return $stmt;
}

/**
* Выводит округленную сумму с пробелом-разделителем и символом рубля
*
* @param int $number
*
* @return string
*/
function yeti_sum ($number)
{
	$value = 0;
	if (is_numeric($number)) {
		$value = ceil($number);
	}
	$num_str = number_format($value, 0, ",", " ");
	$num_str .= " &#8381;";
	return $num_str;
}

/**
* Считает часы и минуты от заданного момента времени до начала следующих суток
*
* @param int $time_moment
*
* @return array
*/
function yeti_time ($time_moment)
{
  $time_gap = (mktime(24, 0, 0) - $time_moment) / 60 / 60;

	return array(floor($time_gap), floor(($time_gap - floor($time_gap)) * 60));
}

function show_error($content, $error)
{
  $content = include_template('404.php', ['error' => $error]);
}