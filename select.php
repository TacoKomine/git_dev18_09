<?php
session_start();
include("funcs.php");
$_SESSION["results"] = "";

if (isset($_POST['category']) && is_array($_POST['category'])) {
    $cate = implode(",", $_POST["category"]);
    $query = "SELECT * FROM ec_table WHERE category IN(".$cate.")";

    if (isset($_POST['max_price']) && $_POST['max_price'] !=""){
        $query .= "AND value <=".$_POST['max_price'].";"; 
    }
}else if(isset($_POST['max_price']) && $_POST['max_price'] !=""){
    $query = "SELECT * FROM ec_table WHERE value <=".$_POST['max_price'].";"; 
}else{
    header("Location: index.php");
    exit;
}
var_dump($query);

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
    $_SESSION["results"] = $view;
}
?>
<?php
header("Location: index.php");
exit;
?>