<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>登入</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./c_ss/log_pages.css" />
    </head>
    <body>
        <div class = "background" >
            <div id = "top_bar"></div>
            <div class = "backstage" >
                <div class = "head">
                    <input id = "log_part" type="button" value="登 入" onclick = "location.href = 'log_in_page.php'">
                    <input id = "sign_part" type="button" value="註 冊" onclick = "location.href = 'sign_up_page.php'">
                </div>
                <div id = "the_back_4">
                    <form method="post" action="log_procedure.php">
                    <p class = "input_bar">
                        帳號：<input type="text" name="member_account"></p>
                    <p class = "input_bar">
                        密碼：<input type="password" name="password"></p>
                    <input id = "log_in_bt" type="submit" value="我要登入" name = "submit">
                    <input id = "forget_bt" type="button" value="忘記密碼" onclick = "location.href = 'forget_page.php'">
                    <input id = "back_bt" type="button" value="訪客瀏覽" onclick = "location.href = 'index.php'">
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>