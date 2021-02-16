<?php
session_start();

//SESSIONを初期化
$_SESSION = array();

//Cookieに保存してあるSessionIDの保存期間を過去のものにして破棄
if( isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');
}

//サーバ側でのセッションIDの削除
session_destroy();

//処理後にリダイレクト
header("Location: index.php");
exit();
?>