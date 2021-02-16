<?php
session_start();
//---------------------------------------
// 1. SESSIONからカートを取得
// ※カートSESSION: array([0]=item,[1]=category,[2]=value,[3]=num,[4]=fname);
//---------------------------------------
$view='';
//$_SESSION["cart"]のデータを取得
foreach($_SESSION["cart"] as $key => $value){
    /*
    $view .= '<li class="cart-list>';
    $view .= '<p class="item-thumb><img src="./img'.$value[4].'" width="200"></p>';
    $view .= '<h2 class="cart-title">'.$value[0].'</h2>';
    $view .= '<p class="cart-category">'.$value[1].'</p>';
    $view .= '<p class="cart-price">'.$value[2].'</p>';
    $view .= '<p class="cart-number">'.$value[3].'</p>';
    $view .= '<a href="cartremove.php?id='.$key.'" class="btn-delete">削除</a>';
    $view .= '</li>';
    */

    $view .= '<li class="cart-list">';
    $view .=    '<ul class="item-container">';
    $view .=       '<li class="item-container-left">';
    $view .=          '<p><img class="cart-thumb" src="./img/'.$value[3].'" alt=""></p>';
    $view .=       '</li>';
    $view .=       '<li class="item-container-middle">';
    $view .=          '<h2 class="cart-title">'.$value[0].'</h2>';
    $view .=          '<p class="cart-category">数量：'.$value[2].'</p>';
    $view .=          '<p class="cart-price">¥'.$value[1].'</p>';
    $view .=       '</li>';
    $view .=       '<li class="item-container-right">';
    $view .=           '<a href="cartremove.php?id='.$key.'" class="btn-delete">削除</a>';
    $view .=       '</li>';
    $view .=     '</ul>';
    $view .= '</li>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style_csm.css">
    <link rel="stylesheet" href="./css/style_cart.css">
</head>
<body class="top">

<!-- header -->
    <header class="header">
        <div class="header__flex">
            <div class="div-top-logo"><a href="./index.php"><img 
            src="./img/common/site-logo.png" class="fig-site-logo" alt="Taco's Beer Market"></a>
            </div>
            <div class="site-title">
                <h1>オーナー選りすぐりのクラフトビール</h1>
                <br>
                <p class="site-subtitle">~日常の食卓に、ちょっと贅沢を~</p>
            </div>
            <nav>
                <ul>
                    <li id="admin">
                        <div class="header-menu admin" visibility="hidden">
                            <a href="./cms/item_list.php">
                            <img src="./img/common/admin-icon.png" class="fig-header-menu">
                            <p class="header-menu-text">管理画面へ</p>
                            </a>
                        </div>
                    </li>
                    <li id="cart">
                        <div class="header-menu">
                            <a href="./cart.php">
                            <img src="./img/common/cart.png" class="fig-header-menu">
                            <p class="header-menu-text">カート</p>
                            </a>
                        </div>
                    </li>
                    <li id="login_user">
                        <div class="header-menu">
                        <img src="./img/common/user-icon.png" class="fig-header-menu" alt="ログイン">
                        <?php echo $u_name;?>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
<!--end header-->

<div class="outer">
    <h1 class="page-title">カートの中身</h1>
    <div class="wrapper wrapper-main flex-parent">
        <main class="wrapper-main">
            <ul class="cart-products">
                <?php echo $view;?>
            </ul>
        </main>
    </div>
</div>
<div class="div_btns">
    <ul class="btn-list">
        <li class="btn-item btn-buy"><a href="index.php">注文を続ける</a></li>
        <li class="btn-item btn-calculate"><a onclick="外部決済サイトへ移動">注文手続きへ</a></li>        
    </ul>
</div>

<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->
</body>
</html>
