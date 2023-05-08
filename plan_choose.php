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
    <body style="width: 800px;margin:0 auto;text-align:center;">
        <h1>健身房方案選擇
        <span>
        <input class = "bt" id = "logout_bt" type="button" value="回上一頁" onclick = "location.href = 'index.php'">
        </span>
        </h1>
        <div>
            <h3 style="color:#e620a4"><?php echo $member_name; ?>，您好，請選擇以下健身方案</h3>
        </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p class = "input_bar">
            預計選擇方案：
            <label><input type="radio" name="plan" value="新手方案" checked>新手方案</label>
            <label><input type="radio" name="plan" value="進階方案">進階方案</label>
            <label><input type="radio" name="plan" value="選手級達人">選手級達人</label></p>
            <input id = "log_in_bt" type="submit" value="確認方案" name = "submit">
            <input id = "log_in_bt" type="submit" value="清空我的方案" name = "clear">
        </form>
        <!-- 選擇方案 -->
        <?php
            if(isset($_POST['submit'])){
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if(!$link){
                    die('資料庫連線失敗！'.mysqli_connect_error());
                }
                $plan = $_POST['plan'];
                $sql_check = "SELECT * FROM plan_choose WHERE member_name = '$member_name'";
                $result_check = mysqli_query($link, $sql_check);
                if(mysqli_num_rows($result_check) == 0){
                    echo "<h3 style='color:blue;'>您現在沒有選擇任何方案！</h3>";
                }else{
                    echo "<h3 style='color:blue;'>您現在選擇的方案為「".$plan."」</h3>";
                }
                $sql1 = "SELECT member_id, member_name, member_account FROM regular_member WHERE member_name = '$member_name'";
                $result1 = mysqli_query($link, $sql1);
                $row = mysqli_fetch_assoc($result1);
                $id = $row["member_id"]; 
                $name = $row["member_name"]; 
                $account = $row["member_account"];   
                $sql2 = "SELECT member_id FROM plan_choose";
                $result2 = mysqli_query($link, $sql2);
                if(mysqli_num_rows($result2) == 0){
                    $sql3="INSERT INTO plan_choose(member_id, member_name, member_account, plan_id) VALUES('$id','$name','$account','$plan')";
                    $result3 = mysqli_query($link, $sql3);
                }else{
                    $sql4 = "UPDATE plan_choose SET plan_id = '$plan' WHERE member_id = '$id'";
                    $result4 = mysqli_query($link, $sql4);
                }
                
                mysqli_close($link);
            }
            if(isset($_POST['clear'])){
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT member_id, member_name, member_account FROM regular_member WHERE member_name = '$member_name'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                $id = $row["member_id"]; 
                $sql_clear = "DELETE FROM `plan_choose` WHERE member_id = '$id'";
                mysqli_query($link, $sql_clear);
                echo '<script>alert("已清除方案！");</script>';
                mysqli_close($link);
            }
        ?>
    </body>

</html>