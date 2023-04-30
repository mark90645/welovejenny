<?php
if (isset($_COOKIE["manager_name"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['manager_name'];
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
                header("location:index.php");
            }
            else
            {
                ?>
                <p>成功了</p>
                <input id = "logout_bt" type="button" value="登出" onclick = "location.href = 'manager_login_page.php'">
                <input id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'manager_change_page.php'">
            <?php
            }
            ?>
            </div>
        </div>
    </body>
</html>