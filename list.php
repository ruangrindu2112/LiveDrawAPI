<?php

header('Content-Type: application/json');

$array = [
  "CAM" => ["name" => 'Cambodia'],
  "CHN" => ["name" => 'China'],
  "HK" => ["name" => 'Hongkong'],
  "MGN" => ["name" => 'Magnum4D'],
  "SD" => ["name" => 'Sydney'],
  "SYD" => ["name" => 'Sydney4D'],
  "SGP" => ["name" => 'Singapore'],
  "SGP45" => ["name" => 'Singapore45'],
  "TW" => ["name" => 'Taiwan'],
  "HK" => ["name" => 'Hongkong'],

];

echo json_encode($array, JSON_PRETTY_PRINT);
