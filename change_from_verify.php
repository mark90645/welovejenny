<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>修改密碼</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./css/change_from_verify.css" /> 
    </head>
    <body>
        <div class = "background" >
            <div id = "top_bar"></div>
            <div class = "backstage" >
                <div id = "the_back_4">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p class = "input_bar">
                        新密碼：<input type="password" name="newpassword"></p>
                    <p class = "input_bar">
                        再次確認密碼：<input type="password" name="newpasswordverify"></p>
                    <input id = "verify" type="submit" value="確認修改" name = "submit">
                </div>
                <?php
                session_start();
                if(isset($_SESSION['account'])) {
                    $account = $_SESSION['account'];
                }
                    if(isset($_POST['submit'])){
                        $conn = require_once "configure.php";
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        if(!$link){
                            die('資料庫連線失敗！'.mysqli_connect_error());
                        }
                        $new = $_POST['newpassword'];
                        $new = strval($new);
                        $newvf = $_POST['newpasswordverify'];
                        $newvf = strval($newvf);
                        if($new==$newvf){
                            $update = "UPDATE regular_member SET password = '$newvf' WHERE member_account = '$account'";
                            mysqli_query($link, $update);
                            echo '<script>alert("修改成功！請重新登入");window.location.href="log_in_page.php";</script>';
                        }else{
                            echo '<script>alert("密碼不一致！請重新設定");</script>';
                        }
                        mysqli_close($conn);
                    }
                ?>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>
