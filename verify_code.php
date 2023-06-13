<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>驗證碼確認</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./css/verify_code.css" /> 
    </head>
    <body>
        <div class = "background" >
            <div id = "top_bar"></div>
            <div class = "backstage" >
                
                <div id = "the_back_4">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p class = "input_bar">
                        驗證碼：<input type="text" name="verification"></p>
                    <input id = "verify" type="submit" value="提交" name = "submit">
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
                        $V = $_POST['verification'];
                        $V = strval($V);
                        $check = "SELECT authentication,verify_time FROM regular_member WHERE member_account = '$account'";
                        $result = mysqli_query($link, $check);
                        $row = mysqli_fetch_assoc($result);
                        $currenttime = date('Y-m-d H:i:s');
                        $currenttime = strtotime($currenttime);
                        $verifytime = strtotime($row["verify_time"]);
                        if($currenttime - $verifytime < 300){
                            if ($row["authentication"]===$V) { 
                                header("location:change_from_verify.php");
                            }else{   
                                echo '<script>alert("驗證碼錯誤！");window.location.href="index.php";</script>';                                  
                                exit;                        
                                }
                        }else{
                            $delete = "UPDATE regular_member SET authentication = '',verify_time='' WHERE member_account = '$account'";
                            mysqli_query($link, $delete);
                            echo '<script>alert("驗證碼已過期！");window.location.href="index.php";</script>'; 
                        }                
                        mysqli_close($conn);
                    }
                ?>
            </div>
           
        </div>
    </body>
</html>
