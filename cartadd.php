<?php
session_start();
//----------------------------------
// 1. 入力チェック
//----------------------------------
//商品名 受信チェック:item
if(!isset($_POST["item"]) || $_POST["item"]==""){
    exit("Param Error!: item");
}
//商品名 受信チェック:category
if(!isset($_POST["category"]) || $_POST["category"]==""){
    exit("Param Error!: category");
}
//金額 受信チェック:value
if(!isset($_POST["value"]) || $_POST["value"]==""){
    exit("Param Error!: value");
}
//id 受信チェック:id
if(!isset($_POST["id"]) || $_POST["id"]==""){
    exit("Param Error!: id");
}

//個数 受信チェック
if(!isset($_POST["num"]) || $_POST["num"]==""){
    exit("Param Error!: num");
}

//ファイル受信チェック 受信チェック ※$_FILES["*****"]["name"]の場合
if(!isset($_POST["fname"]) || $_POST["fname"]==""){
    exit("Param Error!: files");
}

//------------------------------------------
// 2. POSTデータ取得
//------------------------------------------
$id = intval( $_POST["id"] ); //商品名
$item = $_POST["item"]; //商品名
$category = intval($_POST["category"]); //カテゴリ
$value = intval($_POST["value"]); //価格
$num = intval($_POST["num"]); //個数
$fname = $_POST["fname"]; //ファイル名

//------------------------------------------
// 3. カートへ登録 array([0]=item,[1]=value,[2]=num,[3]=fname)
//------------------------------------------
$_SESSION["cart"][$id] = array($item, $value, $num, $fname);

//------------------------------------------
// 4. 次ページへ移動 cart.php
//------------------------------------------
header("Location: cart.php");
exit;
?>