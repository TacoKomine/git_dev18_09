<?php
//------------------------------------------
// 1. 入力チェック
//------------------------------------------
//id 受信チェック:id
if(!isset($_POST["id"]) || $_POST["id"]==""){
    exit("Param Error!: id");
}

//------------------------------------------
// 2. POSTデータ取得
//------------------------------------------
$id = $_POST["id"]; //id

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
// 4. データ削除SQL作成 
//-------------------------------------------
$stmt = $pdo->prepare("DELETE FROM ec_table WHERE id = :id;");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
    header("Location: item_list.php");
    exit;
}
?>