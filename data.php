<?php
$is_auth = rand(0, 1);
$user_name = 'Андрей Ванжа';

$item_type = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$item_table = [
  [
    'Name' => '2014 Rossignol District Snowboard', 
    'Category' => 'Доски и лыжи', 
    'Price' => 10999, 
    'URL' => 'img/lot-1.jpg'
  ],
  [
    'Name' => 'DC Ply Mens 2016/2017 Snowboard', 
    'Category' => 'Доски и лыжи', 
    'Price' => 15999, 
    'URL' => 'img/lot-2.jpg'
  ],
  [
    'Name' => 'Крепления Union Contact Pro 2015 года размер L/XL', 
    'Category' => 'Крепления', 
    'Price' => 8000, 
    'URL' => 'img/lot-3.jpg'
  ],
  [
    'Name' => 'Ботинки для сноуборда DC Mutiny Charocal', 
    'Category' => 'Ботинки', 
    'Price' => 10999, 
    'URL' => 'img/lot-4.jpg'
  ],
  [
    'Name' => 'Куртка для сноуборда DC Mutiny Charocal', 
    'Category' => 'Одежда', 
    'Price' => 7500, 
    'URL' => 'img/lot-5.jpg'
  ],
  [
    'Name' => 'Маска Oakley Canopy', 
    'Category' => 'Разное', 
    'Price' => 5400, 
    'URL' => 'img/lot-6.jpg'
  ]
];

$item_array = [];
$i_table = ['Name' => '', 'Category' => '', 'Price' => 0, 'URL' => ''];
?>
