<?php
// 1. POSTデータ取得
$id = $_GET["id"];

// 2. DB接続
require_once('funcs.php');
$pdo = db_conn();

// 3．SQL文を用意(データ更新：UPDATE)
$sql = "DELETE FROM mil_proto1_itemTable WHERE id=:id";
$stmt = $pdo->prepare($sql);

// 4. バインド変数を用意
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 7．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //8．display.phpへリダイレクト
  redirect('display.php');
}
?>
