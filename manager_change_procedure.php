<?php
$conn=require_once("configure.php");
session_start();

    $manager_name=$_POST["manager_name"];
    $old_password=$_POST["old_password"];
    $new_password=$_POST["new_password"];
    $check = mysqli_query($conn,"SELECT `password` FROM manager WHERE `manager_name` = '".$manager_name."'");
    $a=mysqli_fetch_row($check);
    if($a[0] == $old_password) {
        $change_password = "UPDATE manager SET `password`= '".$new_password."' WHERE `manager_name`= '".$manager_name."'";
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