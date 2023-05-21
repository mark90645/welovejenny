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
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/plan_choose.css" />
    </head>
    <body>
        <div class = "background">
            <div class = "banner">
                <h1 class = "text">健身房方案選擇</h1>
            </div>
            <div class = "side_block">
                <h3 class = "side_text"><?php echo $member_name; ?>，您好<br>請選擇健身方案</h3>
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    $sql = "SELECT * FROM plan_choose WHERE member_name = '$member_name'";
                    $result = mysqli_query($link, $sql);
                    if(mysqli_num_rows($result) == 0){
                        echo "<h3 class = 'side_text'>您沒有選擇任何方案！</h3>";
                    }else{
                        $row = mysqli_fetch_assoc($result);
                        $plan = $row["plan_id"];
                        echo "<h3 class = 'side_text'>您現在選擇的方案為<br>「".$plan."」</h3>";
                    }
                    mysqli_close($link);           
                ?>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p class = "input_bar">
                <div class = "adjust">
                    <div id = "b1">
                        <label class = "labels" id = "rookie">
                            <input class = "check_bt" type="radio" name="plan" value="新手方案">新手方案
                            <div class = "blocks" id = "block_1"></div>
                            <div class = "line" id = "line_a"></div>
                            <p class = "text2 text2a">針對初學者而設計的</p>
                            <p class = "text2 text2a">暢享所有健身器材</p>
                            <p class = "text2 text2a">自由參加各式課程</p>
                            <p class = "text2 text2a">半年會員時長</p>
                        </label>
                        
                    </div>
                    <div id = "b2">
                        <label class = "labels" id = "advance">
                            <input class = "check_bt" type="radio" name="plan" value="進階方案">進階方案
                            <div class = "blocks" id = "block_2"></div>
                            <div class = "line" id = "line_b"></div>
                            <p class = "text2 text2b">針對有基礎者而設計的</p>
                            <p class = "text2 text2b">暢享所有健身器材</p>
                            <p class = "text2 text2b">自由參加各式課程</p>
                            <p class = "text2 text2b">一年會員時長</p>
                            <p class = "text2 text2b">專屬健身教練</p>
                        </label>
                    </div>
                    <div id = "b3">
                        <label class = "labels" id = "master">
                            <input class = "check_bt" type="radio" name="plan" value="達人方案">達人方案
                            <div class = "blocks" id = "block_3"></div>
                            <div class = "line" id = "line_c"></div>
                            <p class = "text2 text2c">針對專業用戶設計的</p>
                            <p class = "text2 text2c">暢享所有健身器材</p>
                            <p class = "text2 text2c">自由參加各式課程</p>
                            <p class = "text2 text2c">兩年會員時長</p>
                            <p class = "text2 text2c">專屬健身教練</p>
                            <p class = "text2 text2c">相關比賽參賽權</p>
                        </label>
                    </div>
                </div>
                </p>
                <div class = "adjust">
                    <input class = "bt" id = "confirm_bt" type="submit" value="確認方案" name = "submit">
                    <input class = "bt" id = "clear_bt" type="submit" value="清空我的方案" name = "clear">
                    <input class = "bt" id = "back_bt" type="button" value="回首頁" onclick = "location.href = 'index.php'">
                    <input class = "bt" id = "update_bt" type="button" value="更新頁面" onclick="Updating();">
                </div>
            </form>
            <script>
                function Updating(){
                    var message = "方案資料更新中，請稍後！";
                    alert(message);
                    location.href = 'plan_choose.php';
                }
            </script>
        </div>
        <!-- 選擇方案 -->
        <?php
            if(isset($_POST['submit'])){
                if(isset($_POST['plan'])){
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if(!$link){
                    die('資料庫連線失敗！'.mysqli_connect_error());
                }
                $plan = $_POST['plan'];
                $sql1 = "SELECT member_id, member_name, member_account FROM regular_member WHERE member_name = '$member_name'";
                $result1 = mysqli_query($link, $sql1);
                $row = mysqli_fetch_assoc($result1);
                $id = $row["member_id"]; 
                $name = $row["member_name"]; 
                $account = $row["member_account"];   
                $sql2 = "SELECT member_id FROM plan_choose WHERE member_id='$id'";
                $result2 = mysqli_query($link, $sql2);
                if(mysqli_num_rows($result2) == 0){
                    $sql3="INSERT INTO plan_choose(member_id, member_name, member_account, plan_id) VALUES('$id','$member_name','$account','$plan')";
                    $result3 = mysqli_query($link, $sql3);                
                }else{
                    $sql4 = "UPDATE plan_choose SET plan_id = '$plan' WHERE member_id = '$id'";
                    $result4 = mysqli_query($link, $sql4);
                }
                
                mysqli_close($link);
                }else{echo '<script>alert("未選擇方案！");</script>';}
                
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