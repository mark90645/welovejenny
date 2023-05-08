<?php
if (isset($_COOKIE["member_account"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['member_account'];
    $sql = "SELECT member_name FROM regular_member WHERE member_account = '".$cookie."'";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $member_name = $row["member_name"];
    mysqli_close($conn);
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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p class = "input_bar">
            預計選擇方案：
            <label><input type="radio" name="plan" value="male">新手方案</label>
            <label><input type="radio" name="plan" value="male">進階方案</label>
            <label><input type="radio" name="plan" value="female">選手級達人</label></p>
            <input id = "log_in_bt" type="submit" value="確認方案" name = "submit">
        </form>
    </body>

</html>