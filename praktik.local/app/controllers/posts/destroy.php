<?php
global $db;


$data= $_POST;
$id=$data['id'];

$db->query("DELETE FROM posts WHERE id=?", [$id]);

if($db->rowCount()){
    if($db->rowCount()){
        $_SESSION['success']='Post deleted successfully';
    }
    else{
        $_SESSION['success']='Post deleted successfully';
    }
}

redirect("/");
