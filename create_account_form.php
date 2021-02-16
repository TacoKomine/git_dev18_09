<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/style_login.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
<style>div{padding:10px; font-size:16px}</style>
<title>アカウント作成</title>
</head>
<body>

<!-- Head[START] -->
<header>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップページへ</a>
        </div>
    </div>
</nav>
</header>
<!-- Head[END] -->

<!-- Main[START]-->
<form method="post" action="add_account.php">
<div class="form-wrapper">
<h1>アカウントを作成</h1>
    <div class="form-item">
      <label for="user_name"></label>
      <input type="text" name="name" required="required" placeholder="お名前"></input>
    </div>
    <div class="form-item">
      <label for="user_name"></label>
      <input type="text" name="id" required="required" placeholder="user id または メールアドレス"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="pw" required="required" placeholder="Password"></input>
        <span class="field-icon">
                    <i toggle="password-field" class="mdi mdi-eye toggle-password"></i>
        </span>
    <input type="hidden" name="is_admin" value="0">
    </div>
    <div class="button-panel">
        <input type="submit"  class="button" value="アカウント作成"></input>
    </div>
</form>
<!-- Main[END]-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
// パスワードの表示・非表示切替
$(".toggle-password").click(function () {
    // iconの切り替え
    $(this).toggleClass("mdi-eye mdi-eye-off");

    // 入力フォームの取得
    let input = $(this).parent().prev("input");
    // type切替
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
</script>
</body>
</html>