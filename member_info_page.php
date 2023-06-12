<?php
session_start();
if (isset($_COOKIE["member_account"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['member_account'];
    $sql = "SELECT member_id, member_name FROM regular_member WHERE member_account = '".$cookie."'";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $member_name = $row["member_name"];
    $member_id = $row["member_id"];
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
        <!--<link rel = "stylesheet" href = "./CSS/board.css" />-->
        <link rel = "stylesheet" href = "./CSS/member_info_page.css" />
        <link rel="icon" href="./pics/JAB.png" type="image/x-icon" />
    </head>
    <body>
        <div class = "background">         
            <input class = "bt" id = "index_bt" type="button" value="回到首頁" onclick = "location.href = 'index.php'">
            <input class = "bt" id = "back_bt1" type="button" value="預約課程" onclick = "location.href = 'reserve_page.php'">
            <input class = "bt" id = "back_bt2" type="button" value="方案選擇" onclick = "location.href = 'plan_choose.php'">
            <input class = "bt" id = "change_bt" type="button" value="修改個人資料" onclick = "location.href = 'change_password.php'">
            <?php
            $member_id = $member_id;
            // 大頭照上傳功能
            //檢查是否有上傳檔案
            if(isset($_FILES['photo'])){
                $file = $_FILES['photo'];

                // 檢查檔案大小
                if($file['size'] <= 5 * 1024 * 1024){
                    // 檢查檔案類型（可根據需求修改）
                    $allowedTypes = ['image/jpeg', 'image/png'];
                    if(in_array($file['type'], $allowedTypes)){
                        // 設定儲存路徑（可根據需求修改）
                        $uploadDir = './pics/';
                        $fileName = uniqid() . '_' . $file['name'];
                        $filePath = $uploadDir . $fileName;

                        if(move_uploaded_file($file['tmp_name'], $filePath)){
                            // 檔案上傳成功
                            echo '<script>alert("檔案上傳成功！");</script>';
                            // 儲存圖片路徑到檔案&SQL
                            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                            $sql = "SELECT pic_path FROM regular_member WHERE member_id='$member_id'";
                            $sql2 = "UPDATE regular_member SET pic_path='$filePath' WHERE member_id='$member_id'";
                            $result_find = mysqli_query($link,$sql);
                            if (mysqli_num_rows($result_find) > 0) {
                                $row = mysqli_fetch_assoc($result_find);
                                $file = $row["pic_path"];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                mysqli_query($link,$sql2);
                            }else{
                                mysqli_query($link,$sql2);
                                } 
                            $headPicPath = $filePath;
                            
                        } else {
                            echo '<script>alert("檔案上傳失敗！");</script>';
                        }
                    } else {
                        echo '<script>alert("不允許的檔案類型！");</script>';
                    }
                } else {
                    echo '<script>alert("檔案大小過大！請使用小於5MB的圖片");</script>';
                }
            }

            // 清空圖片按鈕邏輯
            if(isset($_POST['clear'])){
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT pic_path FROM regular_member WHERE member_id='$member_id'";
                $sql2 = "UPDATE regular_member SET pic_path='' WHERE member_id='$member_id'";
                $result_find = mysqli_query($link,$sql);
                if (mysqli_num_rows($result_find) > 0) {
                    $row = mysqli_fetch_assoc($result_find);
                    $file = $row["pic_path"];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    mysqli_query($link,$sql2);
                }else{
                    mysqli_query($link,$sql2);
                    } 
                $headPicPath = "./pics/memberhead.png"; // 設定為預設圖片路徑
            }
            else{
                // 讀取圖片路徑
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT member_id, pic_path FROM regular_member WHERE member_id='$member_id'";
                $result = mysqli_query($link,$sql);
                $row = mysqli_fetch_assoc($result);
                $path = $row["pic_path"];
                if(empty($path)){
                    $headPicPath = "./pics/memberhead.png";
                }else{
                    $headPicPath = $path;
                }             
            }
            ?>

            <div id="section_1">
                <img alt="memberpic" class="head_pic" src="<?php echo $headPicPath; ?>">
                <div class = "seperate_line"></div>
                <h2 class = "info_text text1">歡迎，<?php echo $member_name; ?></h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input  class = "pic_bt_sp pb1" type="file" name="photo" accept="image/jpeg, image/png" required value="選取圖片">
                    <button class = "pic_bt pb2" type="submit">更換圖片</button>
                </form>
                <form method="POST" action="">
                    <input type="hidden" name="clear" value="1">
                    <button class = "pic_bt pb3" type="submit">清空圖片</button>
                </form>
            </div>
            <div id = "section_2">     
            <?php
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT * FROM plan_choose WHERE member_name = '$member_name'";
                $result = mysqli_query($link, $sql);
                $now=strtotime("+6 Hours");
                $DateAndTime = date('Y-m-d h:i:s a', $now); 
    
                $new=strtotime("+6 Months");
                $advance=strtotime("+1 Years");
                $master=strtotime("+2 Years");
                echo "<h3 class = 'info_text text2'>現在時間：".$DateAndTime."</h3>";
                if(mysqli_num_rows($result) == 0){
                    echo "<h3 class = 'info_text text3'>您現在沒有選擇任何方案！</h3>";
                }else{
                    $row = mysqli_fetch_assoc($result);
                    $plan = $row["plan_id"];
                    if($plan=="新手方案"){
                    echo "<h3 class = 'info_text text3'>目前已選「".$plan."」，時限到".date('Y-m-d', $new)."</h3>";
                    }
                    if($plan=="進階方案"){
                    echo "<h3 class = 'info_text text3'>目前已選「".$plan."」，時限到".date('Y-m-d', $advance)."</h3>";
                    }
                    if($plan=="達人方案"){
                    echo "<h3 class = 'info_text text3'>目前已選「".$plan."」，時限到".date('Y-m-d', $master)."</h3>";
                    }
                }
                mysqli_close($link);           
            ?>
            </div>
                <div id = "section_3">
                <h3 class = "class_text">課 程</h3>
                <div class = "class_line"></div>
                <div class = "text_position">
                    <?php
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        $sql = "SELECT booking_date, class_type
                        FROM bookings
                        WHERE member_account = '".$cookie."'";
                        $result = mysqli_query($link, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $bookdate = $row['booking_date'];
                                $type = $row['class_type'];
                                if ($type == "yoga") {
                                    echo "<h3 class = 'booking_text'>已為您預約".$bookdate."的瑜珈課程</h3>";
                                } elseif ($type == "bike") {
                                    echo "<h3 class = 'booking_text'>已為您預約".$bookdate."的飛輪課程</h3>";
                                } elseif ($type == "aerobic") {
                                    echo "<h3 class = 'booking_text'>已為您預約".$bookdate."的有氧舞蹈課程</h3>";
                                }else{
                                    echo "<h3 class = 'booking_text'>您現在沒有預約任何課程！</h3>";
                                }
                            }
                            
                        mysqli_close($link);           
                    ?>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>