<?php
include_once 'functions.php';

if (file_exists('config.php')) {
    require_once 'config.php';
  } else {
    require_once 'config.default.php';
  }

$required_fields = ['lot-name', 'message', 'lot-rate', 'lot-date', 'lot-step'];
$field_errors = [];
$dt = yeti_time(time());

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

// обработка содержимого _POST - беру данные input из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  foreach ($required_fields as $field_count) {
    if (empty($_POST[$field_count])) {
      $field_errors[$field_count] = "Заполните это поле";
    }
  }
  if (count($field_errors)) {
    print("Ошибка валидации!<br>");
  }

  $today_date = date("Y-m-d H:i:s");
  $l_name = $_POST['lot-name'];
  $lname = htmlspecialchars($l_name);
  $i_msg = $_POST['message'];
  $msg = htmlspecialchars($i_msg);
  $l_rate= $_POST['lot-rate'];
  $lrate = htmlspecialchars($l_rate);
  $l_date = $_POST['lot-date'];
  $ldate = htmlspecialchars($l_date);
  $l_step = $_POST['lot-step'];
  $lstep = htmlspecialchars($l_step);
  foreach($cat_rows as $key=>$vcat) {
      if (strcasecmp($_POST['category'], $vcat['category']) == 0) {
        $id_category = $vcat['id'];
      }
  }
  
  if (isset($_FILES['file-name'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fname = $_FILES['file-name']['tmp_name'];
    $fsize = $_FILES['file-name']['size'];
    $ftype = finfo_file($finfo, $fname);
    if ($ftype!=='image/jpeg' && $ftype!=='image/png' && $ftype!=='image/svg+xml' && $ftype!=='image/gif') {
      print("Выберите изображение с правильным форматом<br>");
    }
    else {
    /*    if ($_FILES(['file-name']['error']) > 0) {
      print("file load error");
    }*/
//    print($_FILES(['file-name']['error'].'<br>'));
      if ($_FILES['file-name']['type'] === 'image/jpeg') {
        $fext = ".jpg";
      }
      elseif ($_FILES['file-name']['type'] === 'image/png') {
        $fext = ".png";
      }
      elseif ($_FILES['file-name']['type'] === 'image/svg+xml') {
        $fext = ".svg";
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
      if (!(move_uploaded_file($_FILES['file-name']['tmp_name'], $fpath.$fname))) {
        print("file movement error");
      }
    }

    $max_pic = 50000;
    if ($fsize > $max_pic) {
      print("Максимальный размер картинки '$max_pic'.");
    }

//  print('<pre>');
//  var_dump($_POST);
//  var_dump($_FILES);
//  print('<br>');

// ввод новой строки в БД
  $sql = "INSERT INTO `schm_lots` (`id`, `date_reg`, `title`, `description`, `image`, `init_price`,
    `deal_price`, `date_end`, `bid_inc`, `id_user`, `id_winner`, `id_category`)
     VALUES (NULL, '$today_date', '$lname', '$msg', '$furl', '$lrate',
     '$lrate', '$ldate', '$lstep', '1', NULL, '$id_category')";
//  print($sql.'<br>');

  $result = mysqli_query($link, $sql);
  if(!$result) {
    $error = mysqli_error($link);
    print('error');
  }

// чтение id новой строки из БД
  $sql = "SELECT schm_lots.id FROM `schm_lots` ORDER BY `id` DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(!$result) {
    $error = mysqli_error($link);
    print('error');
  }
  $last_row = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $id = $last_row[0]['id'];

// чтение нужных данных новой строки и соответствующей категории из БД
  $sql = "SELECT schm_lots.id, schm_lots.title AS item, schm_lots.init_price AS init_price,
  schm_lots.image AS pic, schm_lots.deal_price AS curr_price, schm_lots.description,
  schm_lots.bid_inc, schm_category.category AS category
  FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id 
  AND schm_lots.id = '$id') ORDER BY schm_lots.date_reg DESC";
  $result = mysqli_query($link, $sql);
  if(!$result) {
    $error = mysqli_error($link);
    print('error');
  }
  $last_row = mysqli_fetch_all($result, MYSQLI_ASSOC);
//  var_dump($last_row);

// вызов шаблонов - показать список категорий и картинку лота с новыми данными
  $page_content = include_template('main_lot.php',
    ['item_type'=>$arr_category, 'item_table'=>$last_row, 'wait_time'=>$dt]);

  $layout_content = include_template('layout.php', 
    ['item_type'=>$arr_category, 'content'=>$page_content, 'title'=>'yeticave',
      'is_auth'=>$is_auth, 'user_name'=>$user_name]);
   
  print($layout_content);
  }
}
else {
// вызов шаблонов - показать список категорий и предложить заполнить форму
  $page_content = include_template('add_lot.php', ['item_type'=>$arr_category, 'wait_time'=>$dt]);

  $layout_content = include_template('layout.php', 
    ['item_type'=>$arr_category, 'content'=>$page_content, 'title'=>'yeticave',
      'is_auth'=>$is_auth, 'user_name'=>$user_name]);
   
  print($layout_content);
}