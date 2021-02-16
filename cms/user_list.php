<?php
include("../funcs.php");
session_start();
loginCheck_forAdmin();

// 0.1 ログイン状況のチェック
if( $_SESSION["name"]!="" ){
    $u_name = '<p class="header-menu-text">ようこそ '.$_SESSION["name"].'さま</p>';
    $u_name .= '<p class="header-menu-text"><a href="./logout.php">ログアウト</a></p>';
}else{
    $u_name = '<p id="user_name" class="header-menu-text"><a href="./login.php">ログイン</a></p>';
}
// 0.2 管理者権限のチェック（"is_admin==1" で管理者画面へのリンクを表示）
if( $_SESSION["is_admin"]==1 ){
    $is_admin = 1;
}else{
    $is_admin = 0;
}
if( $_SESSION["is_su"]==1 ){
    $is_su = 1;
}else{
    $is_su = 0;
}

// 1. DB接続
$pdo = db_connect();

// 2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM login_user_table");
$status = $stmt->execute();

// 3.データ表示
$view="";
if($status==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //SELECTデータの数だけ自動でループしてくれる
    while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<tr>';
        $view .=    '<td>'.$res['u_name'].'</td>';
        $view .=    '<td>'.$res['u_id'].'</td>';
        $view .=    '<td>'.$res['is_admin'].'</td>';
        $view .=    '<td>'.$res['is_su'].'</td>';
        $view .=    '<td>';
        $view .=       '<form action="user_delete.php" method="post">';
		$view .=          '<input class="btn-user-delete" type="submit" value="削除">';
		$view .=          '<input type="hidden" name="id" value="'.$res['id'].'">';
		$view .=       '</form>';
        $view .=    '</td>';
        $view .= '</tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Item List</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style_csm.css">
    <link rel="stylesheet" href="../css/style_table.css">
    <link rel="stylesheet" href="../css/style_admin_top.css">
</head>


<!--header -->
<body class="cms">
    <header class="header">
        <div class="header__flex">
            <div class="div-top-logo"><a href="../index.php"><img 
            src="../img/common/site-logo.png" class="fig-site-logo" alt="Taco's Beer Market"></a>
            </div>
        </div>
    </header>
<!-- end header-->

<div class="wrapper wrapper-main flex-parent">
    <div id="admin-option">
        <div class="container-admin-option">
            <a href="./user_list.php">
            <img src="../img/common/icon_users.png" class="fig-site-logo">
            <p class="container-admin-option-text">ユーザー管理</p>
            </a>
        </div>
        <div class="container-admin-option">
            <a href="./item_list.php">
            <img src="../img/common/icon_items.png" class="fig-site-logo">
            <p class="container-admin-option-text">商品登録・削除</p>
            </a>
        </div>
    </div>
</div>

<div class="outer">
    <h1 class="page-title page-title_cms">登録ユーザー一覧</h1>
    <table id="user_table_view">
        <tbody>
            <tr>
                <th>ユーザー名</th>
                <th>ユーザーID</th>
                <th>Admin</th>
                <th>Super User</th>
                <th>操作</th>
            </tr>
            <?php echo $view;?>
        </tbody>
    </table>        
</div>

<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    if(<?=$is_su?>==1){
        $(".btn-user-delete").css({"visibility":"visible"});
        console.log("activate_su_mode");
    }
</script>
</body>
</html>