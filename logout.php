<?php
session_start();
include('funcs.php');
//SESSIONを初期化（配下の変数を全て空っぽにする）
$_SESSION = array();

//Cookieに保存してあるSessionIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

//サーバー側でのセッションID破棄
session_destroy();

redirect('index.php');
exit();

?>