<?php
if (isset($_COOKIE["member_account"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['member_account'];
}
else
{
    $log_check = False;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>教練簡介</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./c_ss/log_pages.css" />
    </head>
    <body>
        <div class = "background" >
        <div id = "banner">
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
                <?php
            if ($log_check == 0)
            {
                ?>
                <input id = "log_bt" type="button" value="登入" onclick = "location.href = 'log_in_page.php'">
                <input id = "sign_bt" type="button" value="註冊" onclick = "location.href = 'sign_up_page.php'">
                <input id = "manager_bt" type="button" value="管理員" onclick = "location.href = 'manager_login_page.php'">
            <?php
            }
            else
            {
                ?>
                <input id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <input id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
            <?php
            }
            ?>
            </div>
        </div>
    </body>
</html>