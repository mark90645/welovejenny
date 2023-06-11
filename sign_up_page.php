<?php
$conn=require_once("configure.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $rand = rand(100000000, 499999999);
    $member_account=$_POST["member_account"];
    $member_name=$_POST["member_name"];
    $password=$_POST["password"];
    $gmail=$_POST["gmail"];
    $birthday=$_POST["birthday"];
    $phone=$_POST["phone"];
    $gender=$_POST["gender"];
    //檢查帳號是否重複
    $check="SELECT * FROM regular_member WHERE member_account='".$member_account."'";
    if(mysqli_num_rows(mysqli_query($conn,$check))==0){
        $sql="INSERT INTO regular_member (member_id, member_name, member_account, password, birthday, gmail, phone, gender)
            VALUES('".$rand."','".$member_name."','".$member_account."','".$password."','".$birthday."','".$gmail."','".$phone."','".$gender."')";
        
        if(mysqli_query($conn, $sql)){
            header("location:log_in_page.php");
            exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        header("refresh:3;url=sign_up_page.php",true);
        exit;
    }
}


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='sign_up_page.php';
    </script>"; 
    
    return false;
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>註冊</title>
        <link rel = "stylesheet" href = "./CSS/board2.css" />
        <link rel = "stylesheet" href = "./CSS/sign_up_page.css" />
        <script>
        function validateForm() {
            var x = document.forms["registerForm"]["password"].value;
            var y = document.forms["registerForm"]["password_check"].value;
            if(x.length<6){
                alert("密碼長度不足");
                return false;
            }
            if (x != y) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
        </script>
    </head>
    <body>
        <div class = "background" >
            <div class = "backstage" >
                <div class = "head">
                    <input class = "redirect" id = "log_part" type="button" value="登入頁面" onclick = "location.href = 'log_in_page.php'">
                    <input class = "redirect" id = "sign_part" type="button" value="註冊頁面" onclick = "location.href = 'sign_up_page.php'">
                </div>
                <img class = "pic" id = "pic_left" src = "./pics/login_head.png"/>
                <div id = "the_back_4">
                    <form name="registerForm" method="post" action="sign_up_page.php" onsubmit="return validateForm()">
                    <h3 class="title">健身房會員註冊</h3>
                        <p class = "input_bar"  id = "gmail_bar">
                            輸入gmail：&ensp;&emsp;&thinsp;<input type="text" name="gmail"></p>
                        <p class = "input_bar" id = "name_bar">
                            輸入名稱：&emsp;&emsp;<input type="text" name="member_name"></p>
                        <p class = "input_bar" id = "account_bar">
                            輸入帳號：&emsp;&emsp;<input type="text" name="member_account"></p>
                        <p class = "input_bar"  id = "password_bar">
                            輸入密碼：&emsp;&emsp;<input type="password" name="password"></p>
                        <p class = "input_bar" id = "check_bar">
                            再次輸入密碼：<input type="password" name="password_check"></p>
                        <p class = "input_bar" id = "birth_bar">
                            輸入生日：&emsp;&emsp;<input type="date" name="birthday"></p>
                        <p class = "input_bar" id = "phone_bar">
                            輸入電話：&emsp;&emsp;<input type="text" name="phone"></p>
                        <p class = "input_bar"  id = "gender_bar">
                            輸入性別：&emsp;&emsp;<input type="radio" name="gender"  value = "male">男
                            <input type="radio" name="gender"  value = "female">女</p>
                        <input class = "bt" id = "sign_up_bt" type="submit" value="我要註冊" name = "submit">
                        <input class = "bt" id = "to_log_bt" type="button" value="我有帳號了！" onclick = "location.href = 'log_in_page.php'">
                        <input class = "bt" id = "back_bt" type="button" value="訪客瀏覽" onclick = "location.href = 'index.php'">
                    </form>
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>