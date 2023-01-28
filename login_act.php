<?php
session_start();
$email      = $_POST["email"];
$password   = $_POST["password"];

// 1. DB接続
require_once('funcs.php');
$pdo = db_conn();

// 2．SQL文を用意(データ検索：SELECT)
$sql    = "SELECT * FROM mil_proto1_userTable WHERE email=:email AND password=:password";
$stmt   = $pdo->prepare($sql);

// 3. バインド変数を用意
$stmt->bindValue(':email', $email); 
$stmt->bindValue(':password', $password); 

// 4. 実行
$status = $stmt->execute();
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
}

//5.抽出データ数を取得
$val = $stmt->fetch(); //1レコードだけ取得する方法

//6.該当レコードがあればSESSIONに値を代入
if ($val["id"] != "") {
    $_SESSION["chk_ssid"]   = session_id();
    $_SESSION["email"]      = $val["email"];
    redirect('display.php'); //login処理OKの場合display.phpへ
}else {
    redirect('index.php'); //NGの場合index.phpへ
}
exit();

?>