<?php
$con = mysqli_connect("localhost", "root", "", "2020_aptitude_madan");
$mysqli = new mysqli("localhost", "root", "", "2020_aptitude_madan");
$category= $mysqli->real_escape_string($_POST['category']);
$question = $mysqli->real_escape_string($_POST['question']);
$option_a= $mysqli->real_escape_string($_POST['option_a']);
$option_b = $mysqli->real_escape_string($_POST['option_b']);
$option_c = $mysqli->real_escape_string($_POST['option_c']);
$option_d = $mysqli->real_escape_string($_POST['option_d']);
$ans = $mysqli->real_escape_string($_POST['ans']);
$sql= "INSERT INTO `question`(`c_id`, `q_title`, `op_a`, `op_b`, `op_c`, `op_d`, `ans_id`) VALUES ('$category','$question','$option_a','$option_a','$option_a','$option_d','$ans')";
// echo  $sql;exit;
$data=mysqli_query($con , $sql);
if($data){
    header("LOCATION: ../view/adminpanel.php?insert=success");
} 
else{
    header("LOCATION: ../view/adminpanel.php?insert=failed");
}
?>