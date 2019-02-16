<?php

include_once 'data.php';
include_once 'functions.php';

$current_time = time();
$nextday = mktime(24, 0, 0);
$time_gap = floor($nextday - $current_time);
$time_gap = $time_gap / 60;
$time_gap = $time_gap / 60;

$page_content = include_template('main.php',
  ['item_type'=>$item_type, 'item_table'=>$item_table, 'wait_time'=>$time_gap]);

  $layout_content = include_template('layout.php', 
  ['item_type'=>$item_type, 'content'=>$page_content, 'title'=>'yeticave',
   'is_auth'=>$is_auth, 'user_name'=>$user_name]);
  
  print($layout_content);
?>