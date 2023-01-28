<?php
// 1. POSTデータ取得
$category = $_POST["category"];
$size     = $_POST["size"];
$color    = $_POST["color"];
$date     = $_POST["date"];
$price    = $_POST["price"];
$location = $_POST["location"];
$status   = $_POST["status"];
$memo     = $_POST["memo"];
$email    = $_POST["email"];
// $fname    = $_FILES["fname"]["name"];


// 2.ファイルアップロード処理
$upload = "./img/"; //画像アップロード用フォルダへのパス
$fname = uniqid(mt_rand(), true); //ファイル名をユニーク化
$fname .= '.'. substr(strrchr($_FILES["fname"]["name"], '.'), 1); //アップロードしたファイルの拡張子を取得
// アップロードした画像をimgフォルダに移動
if (move_uploaded_file($_FILES["fname"]["tmp_name"], $upload.$fname)) {
  //FileUpload:ok
} else {
  echo "Upload failed";
  echo $_FILES['upfile']['error'];
}

// 3. DB接続
require_once('funcs.php');
$pdo = db_conn();

// 4．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO mil_proto1_itemTable(id, category, size, color, date, price, location, status, memo, fname, email, indate)
  VALUES(null, :category, :size, :color, :date, :price, :location, :status, :memo, :fname, :email, sysdate())"
);

// 5. バインド変数を用意
$stmt->bindValue(':category', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':size', $size, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':color', $color, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':location', $location, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':status', $status, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 6. 実行
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
