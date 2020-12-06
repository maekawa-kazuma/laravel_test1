<?php

// DB接続
require 'index.blade.php';

//DB保存

function insertContact($request){

$params = [
  'id' => null,
  'your_name' => $request['your_name'],
  'email' => $request['email'],
  'url' => $request['url'],
  'gender' => $request['gender'],
  'created_at' => null
];
// $params = [
//   'id' => null,
//   'your_name' => 'なまえ',
//   'email' => 'aaa@aaa.com',
//   'url' => 'http://test.com',
//   'gender' => '1',
//   'created_at' => null
// ];

$count = 0;
$columns = '';
$values = '';

foreach(array_keys($params) as $key){
  if($count++>0){
    $columns .= ',';
    $values .= '.';
  }
  $columns .= $key;
  $values .= ':' .$key;
}

$sql = 'insert into contacts ('. $columns .')values('. $values .')';

var_dump($sql);

$stmt = $pdo->prepare($sql); //プリペアードステートメント
$stmt->execute($params); //実行

}