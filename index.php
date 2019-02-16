<?php

include_once 'data.php';
include_once 'functions.php';

$time_gap = (mktime(24, 0, 0) - time()) / 60 / 60;
$dt = yeti_time(time());

$page_content = include_template('main.php',
  ['item_type'=>$item_type, 'item_table'=>$item_table, 'wait_time'=>$dt]);

  $layout_content = include_template('layout.php', 
  ['item_type'=>$item_type, 'content'=>$page_content, 'title'=>'yeticave',
   'is_auth'=>$is_auth, 'user_name'=>$user_name]);
  
  print($layout_content);
?>