<?php

//print('working...');
$item_tp = [];
$item_tbl = [];

include_once 'functions.php';
include_once 'data.php';

$page_content = include_template('main.php', [$item_type, $item_table]);

$layout_content = include_template('layout.php', ['content'=>$page_content, 'title'=>'Главная']);

print($layout_content);

?>
