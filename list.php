<?php

header('Content-Type: application/json');
$data = [];

$data['mafiahasil.top'] = require('list/mafiahasil.php');
$data['lumbungprediksi.com'] = require('list/lumbungprediksi.php');

function getDomain($str)
{
  $str = str_ireplace('https://', '', $str);
  $str = str_ireplace('http://', '', $str);
  return explode('/', $str)[0];

  // return $x = substr($str, 7);
}
file_put_contents('logs.txt', getDomain($_GET['domain']) . PHP_EOL, FILE_APPEND);
// echo getDomain($_GET['domain']);
echo json_encode($data[getDomain($_GET['domain'])], JSON_PRETTY_PRINT);
