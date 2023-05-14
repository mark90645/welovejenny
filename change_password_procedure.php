<?php
$conn=require_once("configure.php");
session_start();
    $cookie = $_COOKIE['member_account'];
    $member_account=$cookie;
    $old_password=$_POST["old_password"];
    $new_password=$_POST["new_password"];
    $check = mysqli_query($conn,"SELECT `password` FROM regular_member WHERE `member_account` = '".$member_account."'");
    $a=mysqli_fetch_row($check);
    if($a[0] == $old_password) {
        $change_password = "UPDATE regular_member SET `password`= '".$new_password."' WHERE `member_account`= '".$member_account."'";
        $result=mysqli_query($conn,$change_password);
        header("location:index.php");
    }


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='change_password.php';
    </script>"; 
    
    return false;
} 
?>