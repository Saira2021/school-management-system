<?php 





if(!isset($_SESSION['id'])){
    header("Location: logout.php");
}



$user_id = $_SESSION['id'];
$user_role = $_SESSION['role'];





?>