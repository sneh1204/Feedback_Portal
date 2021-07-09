<?php
include'../config.php';
session_start();
$user_check=$_SESSION['login_user'];
$role='t';
$ses_sql=mysql_query("select * from user where reg_id='$user_check' and role='$role'");
$row = mysql_fetch_array($ses_sql);
$login_session =$row['reg_id'];
if(!isset($login_session)){
header('location: ../index.php'); 
}
?>