<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>忘記密碼</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./css/forget_pages.css" />
    </head>
    <body>
        <div class = "background" >
            <div class = "backstage" >
                <div class = "the_back_4">
                    <form method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <!-- <p class = "input_bar a">
                        帳號：&thinsp;<input type="text" name="member_account"></p> -->
                    <p class = "input_bar b">
                        gmail：<input type="text" name="gmail"></p>
                    <input class = "bt find_password_bt" type="submit" value="找回密碼" name = "submit">
                    <input class = "bt back_bt" type="button" value="返回" onclick = "location.href = 'log_in_page.php'">
                </div>
                <?php
                    session_start();
                    
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    require 'phpmailer/src/Exception.php';
                    require 'phpmailer/src/PHPMailer.php';
                    require 'phpmailer/src/SMTP.php';
                    if(isset($_POST['submit'])){
                        $conn = require_once "configure.php";
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        if(!$link){
                            die('資料庫連線失敗！'.mysqli_connect_error());
                        }
                        // $account = $_POST['member_account'];
                        // $_SESSION['account'] = $account;
                        $gmail = $_POST['gmail'];
                        $_SESSION['gmail'] = $gmail;
                        $code = rand(100000, 999999);
                        $code = strval($code);
                        $subject = "五花肉健身房，驗證碼信件";
                        $subject = mb_encode_mimeheader($subject, 'UTF-8');
                        $message = "以下為您的重設驗證碼：".$code."，請於五分鐘內輸入";
                        $time = date('Y-m-d H:i:s');
                        
                        $mail =  new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'agentfong2001x1@gmail.com';
                        $mail->Password = 'sgjrmbuwjfhjiano';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->setFrom('agentfong2001x1@gmail.com');
                        $mail->addAddress($gmail);
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body = $message;
             
                        $check = "SELECT gmail FROM regular_member WHERE gmail = '$gmail'";
                        $exist = mysqli_query($link, $check);
                        if (mysqli_num_rows($exist) > 0) { 
                            if ($mail->send()) {
                                echo '<script>alert("郵件已送出！");</script>';
                            } else {
                                echo "郵件發送失敗";
                            }     
                            $sql = "UPDATE regular_member SET authentication = '$code',verify_time='$time' WHERE gmail = '$gmail'";
                            mysqli_query($link, $sql);
                            echo '<script>alert("請重設密碼！");</script>';
                            header("location:verify_code.php");
                        }else{
                                echo '<script>alert("帳號不存在！");</script>';
                            }
                        mysqli_close($conn);
                    }
                   
                ?>
            </div>
        </div>
    </body>
</html>