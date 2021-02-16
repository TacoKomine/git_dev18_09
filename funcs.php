<?php
//XSS対応
function h($val){
    return htmlspecialchars($val, ENT_QUOTES);
}

//Login認証チェック
function loginCheck(){
    if( !isset($_SESSION["chk_ssid"]) ){
        echo "LOGIN ERROR!! :SESSION['chk_ssid'] is empty!!";
        exit();
    }if( $_SESSION["chk_ssid"]!=session_id() ){
        echo "LOGIN ERROR!!: SESSION['chk_ssid'] is invalid value!!" ;
        exit();
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}

/*
function loginCheck(){
    if( !isset($_SESSION["chk_ssid"])||$_SESSION["chk_ssid"]!=session_id() ){
        echo "LOGIN ERROR!!";
        exit();
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}
*/

//Login認証チェック_for Admin
function loginCheck_forAdmin(){
    if( !isset($_SESSION["chk_ssid"])||$_SESSION["chk_ssid"]!=session_id() ){
        echo "LOGIN ERROR!!";
        exit();
    }else if(!isset($_SESSION["is_admin"])||$_SESSION["is_admin"]!=1){
        echo "LOGIN ERROR!!: You are NOT admin!!";
        exit();
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}

//DB接続
function db_connect(){
    try{
        //Password:MAMP='root',XAMPP=''
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost:3306','root','root');
    }catch( PODException $e){
        exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
}
?>