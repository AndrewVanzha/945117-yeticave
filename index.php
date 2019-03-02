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
$dt = yeti_time(time());

$sql = "SELECT * FROM schm_category";
$result = mysqli_query($link, $sql);
}
$cat_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$arr_category = array_column($cat_rows, 'category');

$sql = "SELECT schm_lots.id, schm_lots.title AS item, schm_lots.init_price AS init_price,
  schm_lots.image AS pic, schm_lots.deal_price, schm_category.category AS category
  FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id 
  AND schm_lots.id_winner IS NULL/* AND schm_lots.date_end > NOW()*/) ORDER BY schm_lots.date_reg DESC";
$result = mysqli_query($link, $sql);
if(!$result) {
  $error = mysqli_error($link);
}
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

$page_content = include_template('templates/main.php',
  ['item_type'=>$arr_category, 'item_table'=>$lots, 'wait_time'=>$dt]);

$layout_content = include_template('templates/layout.php', 
  ['item_type'=>$arr_category, 'content'=>$page_content, 'title'=>'yeticave',
   'is_auth'=>$is_auth, 'user_name'=>$user_name]);
   
  print($layout_content);
?>