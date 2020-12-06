<?php 

$contactFile = '.contact.dat';

$contents = fopen($contactFile, 'a+');

$addText = '1行追加' . '\n';

fwrite($contents, $addText);

fclose($contents);

$addText = 'テストです' . '\n';

file_put_contents($contactFile, $addText, FILE_APPEND);

$allData = file($contactFile);

foreach($allData as $lineData){
  $lines = exploade(',', $lineData);
  echo $lines[0]. '<br>';
  echo $lines[1]. '<br>';
  echo $lines[2]. '<br>';
}



?>