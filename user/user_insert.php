<?php
// 1. POSTデータ取得
$email      = $_POST["email"];
$password   = $_POST["password"];
$age        = $_POST["age"];
$gender     = $_POST["gender"];

// 2. DB接続
require_once('../funcs.php');
$pdo = db_conn();

// 3．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO mil_proto1_userTable(id, email, password, age, gender, indate)
  VALUES(null, :email, :password, :age, :gender, sysdate())"
);

// 4. バインド変数を用意
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //7．display.phpへリダイレクト
  redirect('../index.php');
}
?>
