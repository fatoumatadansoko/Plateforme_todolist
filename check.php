<?php

if(isset($_GET['id'])){
    require_once 'config.php';

    $id = $_GET['id'];

    // if(empty($id)){
    //    echo 'error';
    //    exit();
    // } else {
        $stmt = $conn->prepare("UPDATE todos SET checked =1 WHERE id = ?");

        //$stmt = $conn->prepare("UPDATE todos SET checked = CASE WHEN checked = 0 THEN 1 ELSE 0 END WHERE id = ?");
        $res = $stmt->execute([$id]);

        if($res){
            header("Location:todolist.php?mess=succes");
        } else {
            echo "error";
        }
        $conn = null;
        exit();
    }
 else {
    header("Location:todolist.php?mess=error");
}
?>
