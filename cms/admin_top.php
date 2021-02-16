<?php
include("../funcs.php");
session_start();
loginCheck_forAdmin();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin Top</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style_admin_top.css">
    <link rel="stylesheet" href="../css/style_csm.css">
</head>
<body>

<!--header -->
    <header class="header">
        <div class="header__flex">
            <div class="div-top-logo">
                <a href="../index.php">
                    <img  src="../img/common/site-logo.png" class="fig-site-logo">
                </a>
            </div>
        </div>
    </header>
    <!--end header-->

    <div class="outer">
    <h1 class="page-title page-title_cms">管理画面</h1>
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
<!--footer -->
<footer class="footer">
    <p class="copyrights"><small>Copyrights Studio TACO All Rights Reserved.</small></p>
</footer>
<!-- end footer-->

</body>
</html>

