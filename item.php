<?php
include("../funcs.php");
session_start();

//GETでidを取得
if(!isset($_GET["id"]) || $_GET["id"]=="" ){
    exit("ParamError!!");
}else{
    $id = intval($_GET["id"]);
}

// DB接続
try{
    //Password:MAMP='root',XAMPP=''
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost:3306','root','root');
}catch( PODException $e){
    exit('DbConnectError:'.$e->getMessage());
}

// データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM ec_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ表示
$view="";
if($status==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //1レコードだけ取れればよい（と言うかuniqueだし)
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style_main.css">
    <link rel="stylesheet" href="./css/style_item.css">
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

<form action="cartadd.php" method="POST">
    <div class="outer">
        <!--商品本情報-->
        <div class="wrapper wrapper-item flex-parent">
            <main class="wrapper-main item_detail">
                <div class="item_left">
                <!--商品情報-->
                    <p class="item-thumb"><img src="./img/<?=$row["fname"]?>" width="200"></p>
                </div>
                <div class="item_right">
                    <div class="flex-parent item-label">
                        <h1 class="itempage-name"><?=$row["item"]?></h1>
                        <p class="itempage-category"><?=$row["category"]?></p>
                        <p class="itempage-price">¥<?=$row["value"]?></p>
                        <p class="itempage-text"><?=$row["description"]?></p>
                    </div>
                    <!--カートボタン-->
                    <div class="container-purchase">
                        <p><input type="number" value="1" name="num" class="cartin-number">個</p>
                        <input type="submit" class="btn-cartin" value="カートに入れる">
                    </div>
                </div>
            <!--ワザ：ここでは隠して、cartページに値を飛ばす-->
            <input type="hidden" name="item" value="<?=$row["item"]?>" >
            <input type="hidden" name="category" value="<?=$row["category"]?>" >
            <input type="hidden" name="value" value="<?=$row["value"]?>" >
            <input type="hidden" name="id" value="<?=$row["id"]?>" >
            <input type="hidden" name="fname" value="<?=$row["fname"]?>" >
            </main>
        </div>
    </div>
</form>

<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->
</body>
</html>