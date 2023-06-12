<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>忘記密碼</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./c_ss/log_pages.css" />
    </head>
    <body>
        <div class = "background" >
            <div id = "top_bar"></div>
            <div class = "backstage" >
                <div id = "the_back_4">
                    <form method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p class = "input_bar">
                        帳號：<input type="text" name="member_account"></p>
                    <p class = "input_bar">
                        gmail：<input type="text" name="gmail"></p>
                    <input id = "find_password_bt" type="submit" value="找回密碼" name = "submit">
                    <input id = "back_bt" type="button" value="返回" onclick = "location.href = 'log_in_page.php'">
                </div>
                <?php
                    if(isset($_POST['submit'])){
                        $conn = require_once "configure.php";
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        if(!$link){
                            die('資料庫連線失敗！'.mysqli_connect_error());
                        }
                        $account = $_POST['member_account'];
                        $gmail = $_POST['gmail'];
                        $code = rand(10000000, 99999999);
                        $subject = "五花肉健身房，忘記密碼信件";
                        $message = "請查看以下驗證碼：".$code;
                        ini_set("SMTP", "smtp.gmail.com");
                        ini_set("smtp_port", "587");
                        ini_set("smtp_ssl", "tls");
                        ini_set("sendmail_from", "fongcar.mg09@nycu.edu.tw");

                        $headers = 'From: fongcar.mg09@nycu.edu.tw' . "\r\n" .
                                    'Reply-To: fongcar.mg09@nycu.edu.tw' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();              
                        $check = "SELECT member_account,gmail FROM regular_member WHERE member_account = '$account' AND gmail = '$gmail'";
                        $exist = mysqli_query($link, $check);
                        if (mysqli_num_rows($exist) > 0) { 
                            mail($gmail,$subject,$message,$headers);
                            $sql = "UPDATE regular_member SET authentication = '$code' WHERE gmail = '$gmail'";
                            $sql2 = "UPDATE regular_member SET password = '00000000' WHERE gmail = '$gmail'";
                            mysqli_query($link, $sql);
                            mysqli_query($link, $sql2);
                            echo '<script>alert("請重新登入帳號！");</script>';
                        }else{
                                echo '<script>alert("帳號不存在！");</script>';
                            }
                        mysqli_close($conn);
                    }
                   
                ?>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>