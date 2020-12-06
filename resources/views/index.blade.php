<?php

const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1;charset=utf8';
const DB_USER = 'php_user';
const DB_PASSWORD = 'password';



// try{
//   $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
//     PDO::ATTR_EMULATE_PREPARES => false, //SQLインジェクション対策
//   ]);
//   echo '接続成功';
// } catch(PDOException $e){
//   echo '接続失敗' . $e->getMessage() . "\n";
//   exit();
// }



session_start();

echo __FILE__;

// /Users/kazu/projects/laravel_test1/storage/framework/views/1bca1e5913cd651b58322d5620c4c5e691764afc.php
echo '<br>';
echo(password_hash('password', PASSWORD_BCRYPT));
// $2y$10$Eu.Hzw8KZpXZ0Jgg5E.lq..gsu8DM75Ljwus6Di9fuELJsEWBVQP.
// require_once('validation.blade.php');

header('X-FRAME-OPTIONS:DENY');

if(!empty($_GET)){
  echo '<pre>';
  var_dump($_GET);
  echo '</pre>';
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function validation($request){
  $errors = [];

  if(empty($request['your_name']) || 20 < mb_strlen($request['your_name'])){
    $errors[] = '氏名は必須です。20文字以内で入力してください。';
  }

  if(empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
    $errors[] = 'メールアドレスは必須です。正しい形式で入力してください';
  }

if(!empty($request['url'])){
  if(!filter_var($request['url'], FILTER_VALIDATE_URL)){
    $errors[] = 'urlは必須です。正しい形式で入力してください';
  }
}

  if(!isset($request['gender'])){
    $errors[] = '性別を選んでください';
  }
  if(!isset($request['age']) || $request['age'] > 6){
    $errors[] = '年齢を選んでください';
  }
  if(empty($request['contact']) || 200 < mb_strlen($request['contact'])){
    $errors[] = 'お問い合わせ内容は必須です。200文字以内で入力してください。';
  }
  if(empty($request['caution'])){
    $errors[] = '注意事項をお読みください';
  }

  return $errors;
}



 $page_Flag = 0;
 $errors = validation($_GET);

 if(!empty($_GET['btn_confirm']) && empty($errors)){
   $page_Flag = 1;
 }
 
if(!empty($_GET['btn_submit'])){
  $page_Flag = 2;
}
?>

<!doctype html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>



<?php 

class Product{

  private $product = [];

  function __construct($product){

    $this->product = $product;
  }

  public function getProduct(){
    echo $this->product;
  }

  public function addProduct($item){
    $this->product .= $item;
  }

  public static function getStaticProduct($str){
    echo $str;
  }

}

$instance = new Product('テスト');
echo '<br>';
var_dump($instance);
echo '<br>';
$instance->getProduct();
echo '<br>';

$instance->addProduct('追加分');

$instance->getproduct();
echo '<br>';

Product::getStaticProduct('静的');
echo '<br>';

echo '<br>';
function defaultValue($string = 'けいすけ'){
  echo $string . 'です';
}

defaultValue();
echo '<br>';

defaultValue('ホンダ');

function typeHint(string $string){
  var_dump($string);
}

typeHint(6);
  // if(!isset($_SESSION['visited'])){
  //   echo '初回訪問です';

  //   $_SESSION['visited'] = 1;
  //   $_SESSION['date'] = date('c');
  // }else{
  //   $visited = $_SESSION['visited'];
  //   $visited++;
  //   $_SESSION['visited'] = $visited;
  //   echo $_SESSION['visited']. '回目の訪問です、';

  //   if(isset($_SESSION['date'])){
  //     echo '前回訪問は'. $_SESSION['date']. 'です';
  //     $_SESSION['date'] = date('c');
  //   }

  //   setcookie('id', '', time() - 1800, '/');

  //   echo  '<pre>';
  //   var_dump($_SESSION);
  //   echo '</pre>';
  //   echo  '<pre>';
  //   var_dump($_COOKIE);
  //   echo '</pre>';
  // }

  echo 'セッションを破棄します。';
  
  $_SESSION = [];

  if(isset($_COOKIE['PHPSESSID'])){
    setcookie('id', '', time() - 1800, '/');

  }

  session_destroy();

  echo 'セッション';
  echo '<pre>';
  var_dump($_SESSION);
  echo '</pre>';

  echo 'クッキー';
  echo '<pre>';
  var_dump($_COOKIE);
  echo '<pre>';

?>

<?php @include('validation') ?> 

<?php if($page_Flag === 0) : ?>

  <?php 
    if(!isset($_SESSION['csrfToken'])){
      $csrfToken = bin2hex(random_bytes(32));
      $_SESSION['csrfToken'] = $csrfToken;
    }
    $token = $_SESSION['csrfToken'];
  ?>

  <?php if(!empty($errors) && !empty($_GET['btn_confirm'])) : ?>
      <?php echo '<ul>' ?> 
        <?php foreach($errors as $error){
          echo '<li>' . $error . '</li>' ;
        }
        ?>
      <?php echo '</ul>' ?>
    }
  <?php endif ; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form method="GET" action="index.blade.php">
        <div class="form-group">
          <label for="your_name">名前</label>
          <input type="text" name="your_name" class="form-control" id="your_name" value="<?php if(!empty($_GET['your_name'])){echo h($_GET['your_name']);}?>" required>
        </div>
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($_GET['email'])){echo h($_GET['email']);} ?>" required>
        </div>
        <div class="form-group">
          <label for="url">ホームページ</label>
          <input type="text" name="url" class="form-control" id="url" value="<?php if(!empty($_GET['url'])){echo h($_GET['url']);} ?>">
        </div>
  性別
  <div class="form-check form-check-inline">
    <input type="radio" class="form-check-input" id="gender1" name="gender" value="0">
    <?php if(!empty($_GET['gender']) && $_GET['gender'] == 0) 
    { echo 'checked';} ?>
    <label class="form-check-label">男性</label>
    <input type="radio" class="form-check-input" id="gender2" name="gender" value="1" >
    <?php if(!empty($_GET['gender']) && $_GET['gender'] == 1)   
    { echo 'checked';} ?>
    <label class="form-check-label">女性</label>
  </div>

  <div class="form-group">
    <label for="age">年齢</label>
    <select class="form-control" id="age" name="age">
      <option value="">選択してください</option>
      <option value="0" selected>〜19歳以下</option>
      <option value="1">20~30</option>
      <option value="2">30~40</option>
      <option value="3">40~50</option>
      <option value="4">50~</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="contact">お問い合わせ内容</label>
    <textarea class="form-control" id="contact" name="contact" rows="3"><?php if(!empty($_GET['contact'])){echo h($_GET['contact']);}?></textarea>
  </div>
  <div class="form-check">
  <input type="checkbox" class="form-check-input" id="caution" name="caution" value="1">
  <label class="form-check-label" for="caution">注意事項のチェック</label>
  </div>
  <input type="submit" class="btn btn-info" name="btn_confirm" value="確認する">
  <input type="hidden" name="csrf" value="<?php echo $token; ?>">
  </form>
  </div> <!-- col-md-6 -->
  </div>
  </div>
<?php endif; ?>


<?php if($page_Flag === 1) : ?>
  <?php if($_GET['csrf'] === $_SESSION['csrfToken']) : ?>
  <form method="GET" action="index.blade.php">
  名前
  <?php echo h($_GET['your_name']) ?>
  メールアドレス
  <?php echo h($_GET['email']) ?>
  <br>
  ホームページ
  <?php echo h($_GET['url']) ?>
  <br>
  性別
  <?php
  if($_GET['gender'] == 0){ echo '男性'; } 
  if($_GET['gender'] == 1){ echo '女性'; }
  ?>
  <br>
  年齢
  <?php
  if($_GET['age'] === '1'){echo '~19歳';}
  if($_GET['age'] === '2'){echo '20~30';}
  if($_GET['age'] === '3'){echo '30~40';}
  if($_GET['age'] === '4'){echo '40~50';}
  if($_GET['age'] === '5'){echo '50~';}
  ?>
  <br>
  お問い合わせ内容
  <?php echo h($_GET['contact']) ?>
  <br>
  <input type="submit" name="btn_back" value="戻る">
  <input type="submit" name="btn_submit" value="送信する">
  <input type="hidden" name="your_name" value="<?php echo h($_GET['your_name']) ?>">
  <input type="hidden" name="email" value="<?php echo h($_GET['email']) ?>">
  <input type="hidden" name="url" value="<?php echo h($_GET['url']) ?>">
  <input type="hidden" name="gender" value="<?php echo h($_GET['gender']) ?>">
  <input type="hidden" name="age" value="<?php echo h($_GET['age']) ?>">
  <input type="hidden" name="contact" value="<?php echo h($_GET['contact']) ?>">
  <input type="hidden" name="csrf" value="<?php echo h($_GET['csrf']) ?>">
  </form>
<?php endif; ?>
<?php endif; ?>


<?php if($page_Flag === 2) : ?>
  <?php if($_GET['csrf'] === $_SESSION['csrfToken']) : ?>

    <?php require 'insert.php' ;
      insertContact($_GET);
    ?>
    完了画面
    <?php unset($_SESSION['csrfToken']); ?>
  <?php endif; ?>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>