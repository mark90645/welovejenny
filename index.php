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
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>健身房系統首頁</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/index.css" />
    </head>
    <body>
        <div id = "background">
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
            <div id = "section_1">
                <img id = "pic_a" src = "./pictures/0426.png"/>
                <p class = "text_a" id = "cat">喵喵喵</p>
                <p class = "text_a" id = "cat_text">健身房的東東 對。</p>
                <input id = "reserve_bt" type="button" value="課程預約" onclick = "location.href = 'reserve_page.php'">
            </div>
            <div id = "section_2">
                <img id = "pic_b" src = "./pictures/0426.png"/>
                <p class = "text_b" id = "dog">汪汪汪</p>
                <p class = "text_b" id = "dog_text">教練的東東 對。</p>
                <input id = "reserve_bt" type="button" value="教練簡介" onclick = "location.href = 'coach_page.php'">
            </div>
        </div>
    </body>
</html>