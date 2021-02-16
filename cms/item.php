<?php
session_start();
include("funcs.php");
loginCheck();
$pdo = db_connect();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アイテム登録画面</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.bxslider.css">
</head>
<body class="cms">

<!-- header
    <header class="header">
        <p class="site-title"><a href="../index.php"><img 
        src="../img/common/logo.png" alt="G's Academy Tokyo"></a></p>
    </header>

end header-->

    <div class="outer">
    <h1 class="page-title page-title_cms">商品登録</h1>
        <!--商品本情報-->
        <div class="wrapper wrapper-cms">
            <!--商品選択フォーム-->
            <form action="insert.php" method="post" class="flex-parent cart cms-area"
            enctype="multipart/form-data">

            <!--商品情報-->
            <p class="cms-thumb"><img src="hoge" wodth="200"></p>
            <dl class="cms-list">
                <dt>画像</dt>
                <dd><input type="file" name="fname" class="cms-item" acccept="image/*"></dd>
                <dt>商品名</dt>
                <dd><input type="text" name="item" placeholder="商品名を入力" class="cms-item"></dd>
                <dt>カテゴリ</dt>
                <dd>
                    <select name="category" class="cms-item">
                        <option value="Pale Ale">Pale Ale</option>
                        <option value="Wheat Ale">Wheat Ale</option>
                        <option value="American Pale Ale">American Pale Ale</option>
                        <option value="IPA">IPA</option>
                        <option value="Hazy IPA">Hazy IPA</option>
                        <option value="New England IPA">New England IPA</option>
                        <option value="Session IPA">Session IPA</option>
                        <option value="Lager">Lager</option>
                        <option value="Indian Pale Lager">Indian Pale Lager</option>
                        <option value="Pils">Pils</option>
                        <option value="Pilsner">Pilsner</option>
                        <option value="Saison">Saison</option>
                        <option value="Belgian White">Belgian White</option>
                        <option value="White Ale">White Ale</option>
                        <option value="Porter">Porter</option>
                    </select>
                </dd>
                <dt>金額</dt>
                <dd><input type="text" name="value" placeholder="金額を入力" class="cms-item"></dd>
                <dt>商品紹介文</dt>
                <dd><textarea name="description" id="" cols="30" rows="10" placeholder="商品紹介文を入力" class="cms-item"></textarea></dd>
            </dl>
            <!--end 商品情報-->

            <input type="submit" id="btn-update" value="登録">

            <!--
            <ul class="btn-list btn_list_cms">
                <li class="">
                    <a href="./" class="btn-back">戻る</a>
                </li>
                <li class="btn-calculate">
                    <input type="submit" id="btn-update" value="登録">
                </li>
            </ul>
            -->

            </form>
            <!--end 商品選択フォーム-->
        </div>
        <!--end 商品本情報-->
</div>

    <script src="http://code.jquery.com/jquery-3.0.0.js"></script>
    <script>
    //----------------------------------------------
    //画像サムネイル表示
    //----------------------------------------------
    //アップロードするファオルを選択
    $('input[type=file]').change( function(){
        //選択したファイルを取得し、file変数に格納
        var file = $(this).prop('files')[0];
        //画像以外は処理を中止
        if(!file.type.match('image.*')){
            //クリア
            $(this).val(''); //選択されているファイルを空にする
            $('.cms-thumb > img').html(''); //画像表示を空にする
            return;
        }
        //画像表示
        var reader = new FileReader();
        reader.onload = function(){
            $('.cms-thumb > img').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    });
    </script>
</body>
</html>