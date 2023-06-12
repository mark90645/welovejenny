<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html><!--這頁尾端有一段空白未刪 記得找出來-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>登入</title>
        <link rel = "stylesheet" href = "./CSS/board2.css" />
        <link rel = "stylesheet" href = "./CSS/log_in_page.css" />
        <link rel="icon" href="./pics/JAB.png" type="image/x-icon" />
    </head>
    <body>
        <div class = "background" >
            <div class = "backstage" >
                <div class = "head">
                    <input class = "redirect" id = "log_part" type="button" value="登入頁面" onclick = "location.href = 'log_in_page.php'">
                    <input class = "redirect" id = "sign_part" type="button" value="註冊頁面" onclick = "location.href = 'sign_up_page.php'">
                </div>
                <img class = "pic" id = "pic_left" src = "./pics/login_head.png"/><!--我覺得可以學單一入口在左半邊弄個圖片-->
                <h3 class = "title">健身房會員登入</h3>
                <div id = "the_back_4">
                    <form method="post" action="log_procedure.php">
                    <p class = "input_bar" id = "account_bar">
                        帳號：<input type="text" name="member_account"></p>
                    <p class = "input_bar" id = "password_bar">
                        密碼：<input type="password" name="password"></p>
                    <input class = "bt" id = "log_in_bt" type="submit" value="我要登入" name = "submit">
                    <input class = "bt" id = "forget_bt" type="button" value="忘記密碼" onclick = "location.href = 'forget_page.php'">
                    <input class = "bt" id = "back_bt" type="button" value="訪客瀏覽" onclick = "location.href = 'index.php'">
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>