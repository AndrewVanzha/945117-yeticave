<?php

include_once 'data.php';
include_once 'functions.php';

$page_content = include_template('main.php', [$item_type, $item_table]);
/*
$layout_content = include_template('layout.php', 
  [$item_type, $item_table, 
    'content'=>$page_content, 'title'=>'yeticave', 'is_auth'=>$is_auth, 'user_name'=>$user_name]);
*/
    $layout_content = include_template('layout.php', 
    [$item_type, $item_table, 
      $page_content, 'yeticave', $is_auth, $user_name]);
  
  print($layout_content);
?>