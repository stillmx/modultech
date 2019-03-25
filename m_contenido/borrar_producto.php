<?php
include_once 'config.php';
if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else {
    $id = $_GET['id'];
    $sql = "DELETE FROM producto WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->execute([
        'id' => $id
    ]);
echo "<script type='text/javascript'>setTimeout('history.back()',0);</script>";
}
?>
