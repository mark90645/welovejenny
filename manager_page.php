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
            <div style="color:blue">
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    //$link = require_once "configure.php";
                    $sql = "SELECT * FROM regular_member";
                    $result_1 = mysqli_query($link, $sql);
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Name</th></tr>";
                    if (mysqli_num_rows($result_1) > 0) {
                        while($row = mysqli_fetch_assoc($result_1)) {
                            echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["birthday"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>沒有結果</td></tr>";
                    }
                    echo "</table>";
                    mysqli_close($link);
                ?>

            </div>
        </div>
    </body>
</html>