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
        <meta charset = "UTF-8"></meta>
        <title>健身房系統首頁</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/index.css" />
    </head>
    <body>
        <div class = "background">
            <div class = "banner">
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
                <?php
                if ($log_check == 0)
                {
                ?>
                <input class = "bt" id = "log_bt" type="button" value="登入" onclick = "location.href = 'log_in_page.php'">
                <input class = "bt" id = "sign_bt" type="button" value="註冊" onclick = "location.href = 'sign_up_page.php'">
                <input class = "bt" id = "manager_bt" type="button" value="管理員登入" onclick = "location.href = 'manager_login_page.php'">
                <input class = "bt" id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <?php
                }
                else
                {
                ?>
                <input class = "bt" id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <input class = "bt" id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input class = "bt" id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
                <?php
                }
                ?>
            </div>
            <div class = "sections" id = "section_1">
                <img class = "pic" id = "pic_a" src = "./pics/0426.png"/>
                <div class = "base" id = "base_1">
                    <div class = "adjust_index">
                        <p class = "text_a" id = "cat_text"><b>健身房的照片</b></p>
                        <p class = "text_a" id = "cat_text"><b>還有一些簡介</b></p>                     
                    </div>
                </div>
            </div>
            <div class = "sections" id = "section_2">
                <img class = "pic" id = "pic_b" src = "./pics/unnatural.png"/>
                <div class = "base" id = "base_2">
                    <div class = "adjust_index">
                        <p class = "text_a" id = "cat_text"><b>健身房的照片(看要不要弄幻燈片)</b></p>
                        <p class = "text_a" id = "cat_text"><b>方案內容介紹</b></p>                     
                        <?php
                        if($log_check == 0)
                        {?>
                        <?php
                        }else{
                        ?> 
                        <input class = "bt_2" id = "reserve_bt" type="button" value="課程預約" onclick = "location.href = 'reserve_page.php'">
                        <input class = "bt_2" id = "reserve_bt" type="button" value="方案選擇" onclick = "location.href = 'plan_choose.php'">                         
                        <?php
                        }    
                        ?>
                    </div>
                </div>
            </div>
            <div class = "sections" id = "section_3">
                <img class = "pic" id = "pic_c" src = "./pics/paper_town.png"/>
                <div class = "base" id = "base_3">
                    <div class = "adjust_index">
                    <?php
                        $conn=require_once "configure.php";
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        $sql = "SELECT * FROM plan_detail";
                        $result_plan = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result_plan) > 0) {
                            while($row = mysqli_fetch_assoc($result_plan)) {
                                echo "<p>".$row["plan_id"]." : "."<span>".$row["price"]."</span>"."</p>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>沒有結果</td></tr>";
                        }
                        mysqli_close($link);
                    ?>
                        <p class = "text_b" id = "dog">汪汪隊出任務</p>
                        <p class = "text_b" id = "dog_text">幾張教練照片</p>
                        <input class = "bt_2" id = "reserve_bt" type="button" value="教練簡介" onclick = "location.href = 'coach_page.php'">
                    </div>
                </div>
            </div>
        </div>
        <div class = "end">
            <p>聯絡資訊</p>
            <input class = "contact_pic" id = "pic_c" type="button" onclick = "location.href = 'reserve_page.php'"><!--這裡我不會把圖案變按鈕 CSS大神救我-->
            <input class = "contact_pic" id = "pic_d" type="button" onclick = "location.href = 'reserve_page.php'"><img src = "./pics/instagram.png" id = "ig"></button>
        </div>
    </body>
</html>