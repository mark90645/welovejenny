<?php
// Include config file
$conn=require_once "configure.php";
 
// Define variables and initialize with empty values
$member_account=$_POST["member_account"];
$password=$_POST["password"];
$password=strval($password);
$password_hash=password_hash($password,PASSWORD_DEFAULT);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM regular_member WHERE member_account ='".$member_account."'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pw = $row["password"];
    $pw = strval($pw);
    if($pw===$password){
        setcookie("member_account", $member_account, time()+60*60*24*30);
        header("location:index.php");
        exit;
    }else{
            function_alert("帳號或密碼錯誤"); 
        }
}
    else{
        function_alert("Something wrong"); 
    }

    // Close connection
    mysqli_close($link);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='log_in_page.php';
    </script>"; 
    return false;
} 
?>