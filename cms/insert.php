<?php
//------------------------------------------
// 1. 入力チェック
//------------------------------------------
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
//金額 受信チェック:description
if(!isset($_POST["description"]) || $_POST["description"]==""){
    exit("Param Error!: description");
}

//ファイル受信チェック 受信チェック ※$_FILES["*****"]["name"]の場合
if(!isset($_FILES["fname"]["name"]) || $_FILES["fname"]["name"]==""){
    exit("Param Error!: files");
}

//------------------------------------------
// 2. POSTデータ取得
//------------------------------------------
$fname = $_FILES["fname"]["name"]; //ファイル名
$item = $_POST["item"]; //商品名
$category = $_POST["category"]; //カテゴリ
$value = $_POST["value"]; //価格
$description = $_POST["description"]; //商品紹介文

// FileUpload処理
$upload = "../img/"; //画像アップロードフォルダへのパス
//アップロードされたファイルを../img/に移動させる
if(move_uploaded_file($_FILES['fname']['tmp_name'], $upload.$fname )){
    //FileUpload: OK
}else{
    //File upload: NG
    echo "Upload failed";
    echo $_FILE['upfile']['error'];
}

//-------------------------------------------
// 3. DB接続
//-------------------------------------------
try{
    //Password:MAMP='root',XAMPP=''
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost:3306','root','root');
}catch( PODException $e){
    exit('DbConnectError:'.$e->getMessage());
}

//-------------------------------------------
// 4. データ登録SQL作成 
//-------------------------------------------
$stmt = $pdo->prepare("INSERT INTO ec_table(
    id, item, category, value, fname, description, indate)VALUES(
        NULL, :item, :category, :value, :fname, :description, sysdate())");
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':value', $value, PDO::PARAM_INT);
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$status = $stmt->execute();

//-------------------------------------------
// 5. データ登録処理後 
//-------------------------------------------
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    // item.phpへリダイレクト（!!Location: 半角スペース注意!!）
    // exitも忘れず!!
    header("Location: item.php");
    exit;
}
?>
