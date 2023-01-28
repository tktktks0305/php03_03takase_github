<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

// データベース接続関数
function db_conn(){
    try {
        $db_name = "mil_proto1_db";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：MAMPのパスワードはroot
        $db_host = "localhost"; //DBホスト
        $db_port = "8889"; //XAMPPの管理画面からport番号確認
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host.';port='.$db_port.'', $db_id, $db_pw);
        return $pdo;//＄pdoは関数の外に出してあげる必要あり
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//リダイレクト用関数
function redirect($file_name) {
    header('Location: '.$file_name);
}   

//ログインチェック（セッションチェック）用関数
function loginCheck () {
    if (!isset ($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    echo "LOGIN ERROR";
    exit();
    } else {
    session_regenerate_id();
    $_SESSION["chk_ssid"] = session_id();
    }
}