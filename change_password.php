<?php
    $conn=require_once("configure.php");
    session_start();
    $cookie = $_COOKIE['member_account'];
    $sql = "SELECT member_id,phone,birthday FROM regular_member WHERE member_account = '".$cookie."'";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['member_id'];
    $phone = $row['phone'];
    $birth = $row['birthday'];
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>修改個人資料</title>
        <link rel = "stylesheet" href = "./CSS/board2.css" />
        <link rel = "stylesheet" href = "./CSS/change_password.css" />
        <script>
        function validateCheck() {
            var y = document.forms["changeForm"]["new_password"].value;
            var z = document.forms["changeForm"]["password_check"].value;
            if(y.length<8){
                alert("密碼長度不足");
                return false;
            }
            if (y != z) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
        </script>

    </head>
    <body>
        <div class = "background" >
            <div class = "backstage">
                <div class = "head">
                    <input class = "redirect" id = "change_password_part" type="button" value="修改個人資料" onclick = "location.href = 'change_password.php'">
                </div>
                <div id = "the_back_4">
                    <form name="changeForm" method="post" action="change_password_procedure.php" onsubmit="return validateCheck()">
                        <p class = "input_bar">
                            用戶ID：<?php echo $id;?></p>
                        <p class = "input_bar">
                            帳號名稱：<?php echo $cookie;?></p>
                        <p class = "input_bar">	
                            手機號碼：<?php echo $phone;?>&nbsp&nbsp</p>
                        <p class = "input_bar">
                            生日：  <?php echo $birth;?></p>
                        <p class = "input_bar">
                            輸入舊密碼：	&nbsp;&nbsp;&nbsp;&nbsp;&ensp;	<input type="password" name="old_password"placeholder="請輸入舊密碼"></p>
                        <p class = "input_bar">
                            輸入新密碼：&nbsp;&nbsp;&nbsp;&nbsp;&ensp;&ensp;<input type="password" name="new_password"placeholder="請輸入新密碼(8位以上)"></p>
                        <p class = "input_bar">
                            再次輸入新密碼：<input type="password" name="password_check"placeholder="確認密碼"></p>
                        <!-- 之後要改CSS排版 -->
                        <input class = "bt" id = "change_bt" type="submit" value="我要修改" name = "submit">
                        <input class = "bt" id = "back_bt" type="button" value="返回瀏覽" onclick = "location.href = 'index.php'">
                    </form>
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>

