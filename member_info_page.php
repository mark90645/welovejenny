<?php
session_start();
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
}
else
{
    $log_check = False;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"></meta>
        <title>會員資訊</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/member_info_page.css" />
    </head>
    <body>
        <div class = "background">
            <div class = "banner">             
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
                <input class = "bt" id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <input class = "bt" id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input class = "bt" id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
            </div>
            <div id = "section_1">
                <img style="width:200px"alt="memberpic" id = "head_pic" src = "./pics/memberhead.png">
                <h2>歡迎，<?php echo $member_name; ?></h2>
            </div>
            <div id = "section_2">       
                    <input class = "bt" id = "back_bt" type="button" value="回到首頁" onclick = "location.href = 'index.php'">
                    <br><br>
            <?php
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT * FROM plan_choose WHERE member_name = '$member_name'";
                $result = mysqli_query($link, $sql);
                $DateAndTime = date('Y-m-d h:i:s a', time()); 
                $new=strtotime("+6 Months");
                $advance=strtotime("+1 Years");
                $master=strtotime("+2 Years");
                echo "<h3>現在時間：".$DateAndTime."</h3>";
                if(mysqli_num_rows($result) == 0){
                    echo "<h3 style='color:blue;'>您現在沒有選擇任何方案！</h3>";
                }else{
                    $row = mysqli_fetch_assoc($result);
                    $plan = $row["plan_id"];
                    if($plan=="新手方案"){
                    echo "<h3 style='color:blue;'>目前已選「".$plan."」，時限到".date('Y-m-d', $new)."</h3>";
                    }
                    if($plan=="進階方案"){
                    echo "<h3 style='color:blue;'>目前已選「".$plan."」，時限到".date('Y-m-d', $advance)."</h3>";
                    }
                    if($plan=="選手級達人"){
                    echo "<h3 style='color:blue;'>目前已選「".$plan."」，時限到".date('Y-m-d', $master)."</h3>";
                    }
                }
                mysqli_close($link);           
            ?>
                <p class = "text_a" id = "class">已預約xxxx/xx/xx的課程</p>
                <br/><br/><br/>
            </div>
        </div>
    </body>
</html>