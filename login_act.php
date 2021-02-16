<?php
session_start();
 $lid = $_POST["lid"];
 $lpw = $_POST["lpw"];

// 1. DB接続
try{
    //Password:MAMP='root',XAMPP=''
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost:3306','root','root');
}catch( PODException $e){
    exit('DbConnectError:'.$e->getMessage());
}

// 2.データ登録SQL作成
$query = "SELECT * FROM login_user_table WHERE u_id = :lid AND u_pw = :lpw";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
echo $query;
$res = $stmt->execute();

////エラーがある場合
$view="";
if($res==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}

// 3.抽出データ数を取得
$val = $stmt->fetch(); //1レコードだけ取得

// 4.該当レコードがあればSESSIONに値を代入
if( $val["id"] != ""){
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["name"] = $val["u_name"];
    $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["is_su"] = $val["is_su"];
    $_SESSION["login_status"] = true;

    // var_dump( $_SESSION );
    //ログイン処理がOKの場合、select.phpへ遷移
    header("Location: index.php");
}else{
    //ログイン処理がNGの場合
    $_SESSION["login_status"] = false;
    header("Location: login.php");
}
exit();
?>