<?php
session_start();
include("funcs.php");
$view="";

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

$_SESSION["login_status"] = true;

function getItems( $query ){
    $pdo = db_connect();
    $stmt = $pdo->prepare( $query );
    $status = $stmt->execute();

    $view="";

    if($status==false){
        $error = $stmt->errorInfo();
        exit("ErrorQuery".$error[2]);
    }else{
        //SELECTデータの数だけ自動でループしてくれる
        while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $view .= '<div class="item-container">';
            $view .= '<a href="item.php?id='.$res["id"].'" style="text-decoration: none;">';
            $view .=    '<ul class="item-contents">';
            $view .=       '<li class="item-contents-upper">';
            $view .=          '<p><img class="item-thub" src="./img/'.$res['fname'].'" alt=""></p>';
            $view .=       '</li>';
            $view .=       '<li class="item-contents-middle">';
            $view .=          '<p class="products-text item-title">'.$res['item'].'</p>';
            $view .=          '<p class="products-text item-category">'.$res['category'].'</p>';
            $view .=       '</li>';
            $view .=       '<li class="item-contents-lower">';
            $view .=          '<p class="products-text item-price">¥'.$res['value'].'</p>';
            $view .=       '</li>';
            $view .=     '</ul>';
            $view .= '</a>';
            $view .= '</div>';
        }
        return $view;
    }
}



if( !isset($_SESSION["results"]) ){
    $view = getItems( "SELECT * FROM ec_table" );
}else{
    $view = $_SESSION["results"];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style_main.css">
</head>
<body class="top">
    <!--header-->
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
                            <a href="./cms/admin_top.php">
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
        <div class="side-menu">
            <div class="side-menu-filter-list">
                <h2 class="side-menu-title">カテゴリ</h2>
                <form name="form_filter" action="./select.php" method="post">
                <ul>
                    <li><input type="checkbox" name="category[]" value="'Hazy IPA', 'New England IPA'">Hazy, NE-IPA</li>
                    <li><input type="checkbox" name="category[]" value="'Pale Ale', 'American Pale Ale', 'Session IPA','IPA'">Pale Ale系</li>
                    <li><input type="checkbox" name="category[]" value="'Lager', 'Pils', 'Pilsner', 'Indian Pale Lager'">Pilsner, Lager</li>
                    <li><input type="checkbox" name="category[]" value="'Saison', 'Wheat Ale', 'White Ale', 'Belgian White'">Season, White Ale</li>
                    <li><input type="checkbox" name="category[]" value="'Porter'">Porter, Brown Ale</li>
                </ul>
            </div>
<!--
            <div class="side-menu-filter-list">
                <h2 class="side-menu-title">ブルワリー</h2>
                <ul>
                    <li>ヤッホーブリューイング</li>
                    <li>DHC</li>
                    <li>Coedo</li>
                    <li>BrewDog</li>
                    <li>伊勢角屋</li>
                    <li>うちゅうブリューイング</li>
                </ul>
            </div>
-->
            <div class="side-menu-filter-list">
                <h2 class="side-menu-title">価格帯</h2>
                <ul>
                    <li><input type="radio" name="max_price" value="350">〜 ¥350</li>
                    <li><input type="radio" name="max_price" value="400">〜 ¥400</li>
                    <li><input type="radio" name="max_price" value="500">〜 ¥500</li>
                    <li><input type="radio" name="max_price" value="600">〜 ¥600</li>
                    <li><input type="radio" name="max_price" value="9999">¥600 〜</li>
                </ul>
            </div>
            <input type="submit" id="btn-filter" value="この条件で検索する">
            </form>
        </div>
        <div class="main-item-list">
            <div class="wrapper wrapper-main flex-parent">
                <main class="wrapper-main">
                    <div class="item-list">
                        <?php echo $view;?>
                    </div>
                </main>
            </div>
        </div>
    </div>

<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    if(<?=$is_admin?>==1){
        $(".admin").css({"visibility":"visible"});
        console.log("activate_admin_mode");
    }
</script>
</body>
</html>