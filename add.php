<?php
include_once 'functions.php';

if (file_exists('config.php')) {
    require_once 'config.php';
  } else {
    require_once 'config.default.php';
  }

$required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$field_errors = [];
$file_field_error = [];
$form_values = [];
$field_error_announce = [
  'lot-name' => 'Введите наименование лота',
  'category' => 'Выберите категорию',
  'message' => 'Напишите описание лота',
  'lot-rate' => 'Введите начальную цену',
  'lot-step' => 'Введите шаг ставки',
  'lot-date' => 'Введите дату завершения торгов'
];
$lname = '';
$msg = '';
$lrate= '';
$ldate = '';
$lstep = '';
$max_pic = 50000;
$is_field_error = false;
$today_date = date("Y-m-d H:i:s");
$dt = yeti_time(time());
//mysqli_real_escape_string (mysqli $link , string $escapestr);
foreach ($required_fields as $field_value) {
    $field_errors[$field_value] = '';
    $form_values[$field_value] = '';
}
//var_dump($field_errors);
//print("field_errors<br>");

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$link) {
  $error = mysqli_connect_error();
}
mysqli_set_charset($link, "utf8");
mysqli_options($link, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

// загрузка из БД названий категорий
$sql = "SELECT * FROM schm_category";
$result = mysqli_query($link, $sql);
if(!$result) {
  $error = mysqli_error($link);
}
$cat_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$arr_category = array_column($cat_rows, 'category');

if (!isset($_SERVER['REQUEST_METHOD'])) {
  print("error with page request");
}
else {
  // обработка содержимого _POST - беру данные input из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// подбираю файл с изображением
  if (isset($_FILES['file-name'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fname = $_FILES['file-name']['tmp_name'];
    $fsize = $_FILES['file-name']['size'];
    $ftype = finfo_file($finfo, $fname);
    if ($ftype!=='image/jpeg' && $ftype!=='image/gif') {
      print("Выберите изображение с правильным форматом<br>");
      $file_field_error[0] = "Добавьте изображение в правильном формате";
    }
    else {
      /*if ($_FILES(['file-name']['error']) > 0) {
        print("file load error");
      }*/
      //print($_FILES(['file-name']['error'].'<br>'));
      if ($_FILES['file-name']['type'] === 'image/jpeg') {
        $fext = ".jpg";
      }
      elseif ($_FILES['file-name']['type'] === 'image/gif') {
        $fext = ".gif";
      }
      else {
        $fext = ".tx_";
        print("suspicious image file");
      }
      $fname = uniqid().$fext;
      $fpath = __DIR__.'/img/';
      $furl = 'img/'.$fname;
      //print($furl.'<br>');
    }
    if ($fsize > $max_pic) {
      $file_field_error[1] = "Превышение размеров изображения: ".$max_pic." байт максимум";
      print("Максимальный размер картинки '$max_pic'.");
    }
  }
  else {
    $file_field_error[0] = "Добавьте изображение в правильном формате";
  }

// просмотр всех полей полученной формы
  $lname = (isset($_POST['lot-name']))? htmlspecialchars($_POST['lot-name']) : '';
//  $form_values['lot-name'] = mysqli_real_escape_string($lname);
  $form_values['lot-name'] = $lname;
  $msg = (isset($_POST['message']))? htmlspecialchars($_POST['message']) : '';
  $form_values['message'] = $msg;
  $lrate = (isset($_POST['lot-rate']))? htmlspecialchars($_POST['lot-rate']) : '';
  $form_values['lot-rate'] = $lrate;
  $ldate = (isset($_POST['lot-date']))? htmlspecialchars($_POST['lot-date']) : '';
  $form_values['lot-date'] = $ldate;
  $lstep = (isset($_POST['lot-step']))? htmlspecialchars($_POST['lot-step']) : '';
  $form_values['lot-step'] = $lstep;
//  var_dump($cat_rows);
//  print(' cat_rows<br>');
  foreach($cat_rows as $key=>$vcat) {
    if (isset($_POST['category']) && (strcasecmp($_POST['category'], $vcat['category'])==0)) {
      $id_category = $vcat['id'];
      $form_values['category'] = $vcat['category'];
    }
  }/* else id-?*/
//  var_dump($_POST);
//  print(' _POST<br>');
//  var_dump($form_values);
//  print(' form_values<br>');

  $is_field_error = false;
  foreach ($required_fields as $field_value) {
    if (empty($_POST[$field_value])) {
//      print("empty field!<br>");
      $field_errors[$field_value] = $field_error_announce[$field_value];
      $is_field_error = true;
    }
  }
//  var_dump($field_errors);
//  print("field_errors<br>");

  // обнаружены ли ошибки?
  if ($is_field_error || count($file_field_error)>0) {
    $field_errors['form-invalid'] = 'form--invalid';
//    print("count => error".'<br>');
//    print($is_field_error.'<br>');
//    print(count($file_field_error).'<br>');
//    var_dump($form_values);
//    print(' form_values<br>');
//    var_dump($field_errors);
//    print("field_errors<br>");
    
    // вызов шаблонов - предложить снова заполнить форму и исправить ошибки 
    $page_content = include_template('add_lot.php',
      ['item_type'=>$arr_category, 'field_errors'=>$field_errors, 'form_values'=>$form_values, 'wait_time'=>$dt]);
  }
  else {
    // сформировать новый лот, записать соответствующие данные и показать его
    foreach ($required_fields as $field_value) {
      $field_errors[$field_value] = '';
    }
    foreach ($file_field_error as $fcount) {
      $field_errors[$fcount] = '';
    }
    // переписываю файл изображения
    if (!(move_uploaded_file($_FILES['file-name']['tmp_name'], $fpath.$fname))) {
      print("image file movement error");
    }
    // ввод новой строки в БД

    $sql = "INSERT INTO `schm_lots` (`id`, `date_reg`, `title`, `description`, `image`, `init_price`,
      `deal_price`, `date_end`, `bid_inc`, `id_user`, `id_winner`, `id_category`)
      VALUES (NULL, '$today_date', '$lname', '$msg', '$furl', '$lrate',
      '$lrate', '$ldate', '$lstep', '1', NULL, '$id_category')";
//    print($sql.'<br>');

    $result = mysqli_query($link, $sql);
    if($result) {
    //if(1) {
        // определение id последней строки из БД
      $sql = "SELECT schm_lots.id FROM `schm_lots` ORDER BY `id` DESC LIMIT 1";
      $result = mysqli_query($link, $sql);
      if($result) {
        $last_row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $id = $last_row[0]['id'];
        //var_dump($last_row);
        //print($id.'  '.$dt.'<br>');

        // чтение нужных данных новой строки и соответствующей категории из БД
        $sql = "SELECT schm_lots.id, schm_lots.title AS item, schm_lots.init_price AS init_price,
          schm_lots.image AS pic, schm_lots.deal_price AS curr_price, schm_lots.description,
          schm_lots.bid_inc, schm_category.category AS category
          FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id 
          AND schm_lots.id = '$id') ORDER BY schm_lots.date_reg DESC";
        $result = mysqli_query($link, $sql);
        if($result) {
          $last_row = mysqli_fetch_all($result, MYSQLI_ASSOC);

          // вызов шаблонов - показать картинку лота с новыми данными и списком категорий
          $page_content = include_template('main_lot.php',
            ['item_type'=>$arr_category, 'item_table'=>$last_row, 'wait_time'=>$dt]);
          }
          else {
            print("ошибка чтения последней записи из БД");
            $error = mysqli_error($link);
            $content = include_template('404.php', ['item_type'=>$arr_category]);
          }
        }
        else {
          print("ошибка определения id последней строки из БД");
          $error = mysqli_error($link);
          $content = include_template('404.php', ['item_type'=>$arr_category]);
        }
      }
      else {
        print("ошибка записи в БД");
        $error = mysqli_error($link);
        $content = include_template('404.php', ['item_type'=>$arr_category]);
      }

/*
    $sql = "INSERT INTO `schm_lots` (`id`, `date_reg`, `title`, `description`, `image`, `init_price`,
      `deal_price`, `date_end`, `bid_inc`, `id_user`, `id_winner`, `id_category`)
      VALUES (NULL, '$today_date', ?, ?, '$furl', ?,
      ?, ?, ?, '1', NULL, '$id_category')";

    $stmt = db_get_prepare_stmt($link, $sql,   );
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
      $lot_id = mysqli_insert_id($link); // последний id
      header("Location: lot.php?id=".$lot_id);
    }
    else {
      $content = include_template('404.php', ['item_type'=>$arr_category]);
    }
*/
  }
}
else {
  // вызов шаблонов - предложить заполнить форму и показать список категорий 
  $page_content = include_template('add_lot.php',
    ['item_type'=>$arr_category, 'field_errors'=>$field_errors, 'form_values'=>$form_values, 'wait_time'=>$dt]);
}

$layout_content = include_template('layout.php', 
['item_type'=>$arr_category, 'content'=>$page_content, 'title'=>'yeticave',
'is_auth'=>$is_auth, 'user_name'=>$user_name]);

  print($layout_content);
}