<?php
// Include config file
$conn=require_once "configure.php";
 
// Define variables and initialize with empty values
$manager_name=$_POST["manager_name"];
$password=$_POST["password"];
$password_hash=password_hash($password,PASSWORD_DEFAULT);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM manager WHERE manager_name ='".$manager_name."'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1 && $password==mysqli_fetch_assoc($result)["password"]){
        setcookie("manager_name", $manager_name, time()+60*60*24*30);
        header("location:manager_page.php");
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
     window.location.href='manager_login_page.php';
    </script>"; 
    return false;
} 
?>