<?php
session_start(); 
$_SESSION = array(); 
session_destroy(); 
setcookie("member_account","",time()-60*60*24*30);
header('location:index.php'); 
?>