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
<html>
    <head>
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>選擇方案</title>
        <!-- <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/manager_page.css" /> -->
    </head>
    <body>
        <h1>健身房方案選擇
        <span>
        <input class = "bt" id = "logout_bt" type="button" value="回上一頁" onclick = "location.href = 'index.php'">
        </span>
        </h1>
    </body>

</html>