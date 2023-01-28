<?php
//0.セッションチェック
session_start();
include('funcs.php');
loginCheck();
$email = $_SESSION["email"];

//1.  DB接続します
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare('SELECT * FROM mil_proto1_itemTable WHERE email=:email');
//バインド変数を用意
$stmt->bindValue(':email', $email); 

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<div class = "col">';
    $view .=  '<div class = "card h-100">';
    $view .=    '<div class = "card-header">';
    $view .=      h($result['category']).'（'.h($result['status']).'）';
    $view .=    '</div>';
    $view .=    '<img src="./img/'.h($result['fname']).'" class = "card-img-top">';
    $view .=    '<ul class = "list-group list-group-flush">';
    $view .=      '<li class = "list-group-item">サイズ：'.h($result['size']).'</li>';
    $view .=      '<li class = "list-group-item" style="color:'.h($result['color']).'">色：■'.h($result['color']).'</li>';
    $view .=      '<li class = "list-group-item">購入時期：'.h($result['date']).'</li>';
    $view .=      '<li class = "list-group-item">購入金額：'.h($result['price']).'</li>';
    $view .=      '<li class = "list-group-item">保管場所：'.h($result['location']).'</li>';
    $view .=      '<li class = "list-group-item">メモ：'.h($result['memo']).'</li>';
    $view .=    '</ul>';
    $view .=    '<div class = "card-body text-end">';
    $view .=      '<a class = "btn btn-primary me-2" href="upd_view.php?id='.h($result['id']).'">更新</a>';
    $view .=      '<button type="button" class="btn btn-secondary btn-for-delete" data-bs-toggle="modal" data-bs-target="#exampleModal" data-deleteId="'.h($result['id']).'">削除</button>';
    $view .=    '</div>';
    $view .=    '<div class = "card-footer text-end">';
    $view .=    '<small class="text-muted">登録:'.h($result['indate']).'</small>';
    $view .=    '</div>';
    $view .=  '</div>';
    $view .= '</div>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- 自作CSSの読み込み -->
  <link rel="stylesheet" href="./css/layout.css">
  <!-- Font Awesome読み込み -->
  <script src="https://kit.fontawesome.com/f569121d87.js" crossorigin="anonymous"></script>
  <title>登録アイテム一覧</title>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="display.php">持ち物管理アプリPrototype</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="register.php">アイテム登録</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="display.php">登録アイテム一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">（作成中）保管場所登録</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">（作成中）登録アイテム分析</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">ログアウト</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container container-m">
  <legend class="mb-3"><?=$_SESSION['email'];?>さんの登録アイテム一覧</legend>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?= $view; ?>
  </div>
</div>

<!-- 削除用Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        登録したアイテムを削除してもよろしいですか？
      </div>
      <div class="modal-footer" id="modalForDelete">
        
      </div>
    </div>
  </div>
</div>



<!-- Main[End] -->

<footer class="footer container-m">MIL 4th php03_03takase</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<!-- 削除用jQuery -->
<script>
let deleteId = "";
$('.btn-for-delete').on('click', function () {
  deleteId = $(this).attr('data-deleteId');
  // console.log(deleteId);
  $('#modalForDelete').html(`<button type="button" class="btn btn-primary" data-bs-dismiss="modal">戻る</button><a class = "btn btn-secondary" href="delete.php?id=${deleteId}">削除</a>`);
});
</script>

</body>
</html>
