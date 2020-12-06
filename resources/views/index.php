<?php

require 'index.blade.php';

// ユーザー入力なし query
$sql = 'select * from contacts where id = 4';
$stmt = $pdo->query($sql);

$result = $stmt->fetchall();

var_dump($result);


// ユーザー入力あり prepare, bind ,execute

$sql = 'select * from contacts where id = :id';


$result = $stmt->fetchall();

echo '<pre>';
var_dump($result);
echo '</pre>';

// トランザクション まとめて処理 beginTransaction, commit, rollback

$pdo->beginTransaction();

try{

  //sql処理
  $stmt = $pdo->prepare($sql); //プリペアードステートメント
  $stmt->bindValue('id',4,PDO::PARAM_INT); //紐付け
  $stmt->execute(); //実行

  $pdo->commit();

}catch(PDOException $e){
  $pdo->rollback();//更新のキャンセル
}
