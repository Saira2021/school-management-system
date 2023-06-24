<?php include_once('header.php'); ?>
<?php include_once('nav_admin.php'); ?>
<?php include_once('validate.php'); ?>
<?php 


if($user_role == 'admin'){
    header("Location: back_admin.php");
}elseif($user_role == 'student'){
    header("Location: back_student.php");
}elseif($user_role == 'faculty'){
    header("Location: back_faculty.php");
}


?>





