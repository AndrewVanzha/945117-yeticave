<?php

include_once 'data.php';
include_once 'functions.php';

if(file_exists('config.php')) {
  require_once 'config.php';
} else {
  require_once 'config.default.php';
}

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$link) {
  $error = mysqli_connect_error();
}
mysqli_set_charset($link, "utf8");
mysqli_options($link, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

$sql = "SELECT * FROM schm_category";
$result = mysqli_query($link, $sql);
if(!$result) {
  $error = mysql_error($link);
}
$cat_rows = mysqli_fetch_all($result);
foreach($cat_rows as $row) {
  $arr_category[] = $row[1];
}

$sql = "SELECT schm_lots.title, schm_lots.init_price, schm_lots.image, schm_lots.deal_price, schm_category.category AS catt
  FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id 
  AND schm_lots.id_winner IS NULL) ORDER BY schm_lots.date_reg DESC";
$result = mysqli_query($link, $sql);
if(!$result) {
  $error = mysql_error($link);
}
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($lots as $lot_row) {
  $i_table['Name'] = $lot_row['title'];
  $i_table['Category'] = $lot_row['catt'];
  $i_table['Price'] = $lot_row['init_price'];
  $i_table['URL'] = $lot_row['image'];
  array_push($item_array, $i_table);
}

$time_gap = (mktime(24, 0, 0) - time()) / 60 / 60;
$dt = yeti_time(time());

$page_content = include_template('main.php',
  ['item_type'=>$arr_category, 'item_table'=>$item_array, 'wait_time'=>$dt]);

  $layout_content = include_template('layout.php', 
  ['item_type'=>$arr_category, 'content'=>$page_content, 'title'=>'yeticave',
   'is_auth'=>$is_auth, 'user_name'=>$user_name]);
  
  print($layout_content);
?>