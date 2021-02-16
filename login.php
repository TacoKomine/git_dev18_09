<?php
session_start();
if($_SESSION["login_status"]==false){
    $message = "<p>※IDかパスワードが間違っています</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="./css/style_main.css">
<link rel="stylesheet" href="./css/style_login.css">
<style>div{padding:10px; font-size:16px}</style>
<title>ログイン</title>
</head>
<body>

<!-- Head[START] -->
<header>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップへ戻る</a>
        </div>
    </div>
</nav>
</header>
<!-- Head[END] -->

<!-- Main[START]-->
<!-- lid, lpw -->
<form method="post" action="login_act.php">
<div class="form-wrapper">
<h1>ログイン</h1>
    <div class="form-item">
      <label for="user_id"></label>
      <input type="text" name="lid" required="required" placeholder="User Id or Email Address"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="lpw" required="required" placeholder="Password"></input>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Sign In" value="Sign In"></input>
    </div>
</form>

<div class="form-footer">
    <?php echo $message;?>
    <p><a href="./create_account_form.php">新しくアカウントを作る場合はこちら</a></p>
    <p>ー</p>
    <p><a href="#">パスワードをお忘れですか?</a></p>
</div>
<!-- Main[END]-->
</body>
</html>
