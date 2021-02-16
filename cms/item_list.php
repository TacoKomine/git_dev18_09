<?php
include("../funcs.php");
session_start();
loginCheck_forAdmin();

// 1. DB接続
$pdo = db_connect();

/*
try{
    //Password:MAMP='root',XAMPP=''
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost:3306','root','root');
}catch( PODException $e){
    exit('DbConnectError:'.$e->getMessage());
}
*/

// 2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM ec_table");
$status = $stmt->execute();

// 3.データ表示
$view="";
if($status==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //SELECTデータの数だけ自動でループしてくれる
    while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<li class="cart-list">';
        $view .=    '<ul class="item-container">';
        $view .=       '<li class="item-container-left">';
        $view .=          '<p><img class="cart-thumb" src="../img/'.$res['fname'].'" alt=""></p>';
        $view .=       '</li>';
        $view .=       '<li class="item-container-middle">';
        $view .=          '<h2 class="cart-title">'.$res['item'].'</h2>';
        $view .=          '<p class="cart-category">'.$res['category'].'</p>';
        $view .=          '<p class="cart-price">¥'.$res['value'].'</p>';
        $view .=       '</li>';
        $view .=       '<li class="item-container-right">';
        $view .=          '<a href="#" class="btn-update">編集</a>';
        $view .=          '<form action="delete.php" method="post">';
		$view .=             '<input class="btn-delete" type="submit" value="削除">';
		$view .=             '<input type="hidden" name="id" value="'.$res['id'].'">';
		$view .=          '</form>';
        $view .=       '</li>';
        $view .=     '</ul>';
        $view .= '</li>';
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
<body class="cms">

<!--header -->
<header class="header">
    <div class="header__flex">
        <div class="div-top-logo"><a href="../index.php"><img 
        src="../img/common/site-logo.png" class="fig-site-logo" alt="Taco's Beer Market"></a>
        </div>
    </div>
</header>
<!--end header-->

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
    <h1 class="page-title page-title_cms">登録済み商品一覧</h1>
    <div class="wrapper wrapper-main flex-parent">
        <main class="wrapper-main">
            <ul class="cart-products">
                <?php echo $view;?>
            </ul>
        </main>
    </div>
</div>

<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->

</body>
</html>