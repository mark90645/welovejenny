<?php
$conn=require_once("configure.php");
session_start();

    $manager_account=$_POST["manager_account"];
    $old_password=$_POST["old_password"];
    $new_password=$_POST["new_password"];
    $check = mysqli_query($conn,"SELECT `password` FROM manager WHERE `manager_account` = '".$manager_account."'");
    $a=mysqli_fetch_row($check);
    if($a[0] == $old_password) {
        $change_password = "UPDATE manager SET `password`= '".$new_password."' WHERE `manager_account`= '".$manager_account."'";
        $result=mysqli_query($conn,$change_password);
        header("location:manager_page.php");
    }


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='manager_change_page.php';
    </script>"; 
    
    return false;
} 
?>