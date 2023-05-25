<?php
session_start();
if (isset($_COOKIE["manager_account"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['manager_account'];
    $sql = "SELECT manager_name FROM manager WHERE manager_account = '".$cookie."'";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $manager_name = $row["manager_name"];
    mysqli_close($conn);
}
else
{
    $log_check = False;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>管理者頁面</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/manager_page.css" />
    </head>
    <body>
        <div id = "background">
            <div id = "side_box">
                <?php
                if ($log_check == 0)
                {
                    header("location:index.php");
                }
                else
                {
                ?>
                    <p class = "side_text object1">管理員：</p>
                    <p class = "side_text subject"><?php echo $manager_name; ?></p>
                    <p class = "side_text object2">連線成功</p>
                    <div class = "side_line"></div>
                    <div class = "side_bt">
                        <input class = "_bt" id = "logout_bt" type="button" value="登出" onclick = "location.href = 'index.php'">
                        <input class = "_bt" id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'manager_change_page.php'">
                    </div>
                <?php
                }
                ?>
            </div>
            <h2 style="cursor:pointer;text-align:center"onclick="reload()">重整頁面</h2>
            <script>
                function reload(){                  
                    location.href = 'manager_page.php';
                }
            </script>
            <div class = "change_page">
                <button class = "change_bt" id = "cbt_1" onclick="showPageA('box_1')">會員總覽</button>
                <button class = "change_bt" id = "cbt_2" onclick="showPageB('box_2')">新增會員資料</button>
                <button class = "change_bt" id = "cbt_3" onclick="showPageA('box_3')">課程管理</button>
                <button class = "change_bt" id = "cbt_4" onclick="showPageB('box_4')">方案管理</button>
                <button class = "change_bt" id = "cbt_5" onclick="showPageB('box_5')">批量匯入資料</button>
            </div>
            <!-- 會員資料總覽 -->
            <div style="color:red;text-align:center"class="boxes box_1" id = "box_1">
                <h3 style="color:blue">會員總覽</h3>
                <hr/>
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    $sql = "SELECT regular_member.member_id, regular_member.member_name, regular_member.member_account, password, birthday, gmail, phone, gender, plan_id FROM regular_member LEFT JOIN plan_choose ON regular_member.member_id = plan_choose.member_id";
                    $result_1 = mysqli_query($link, $sql);
                    echo "<form action='' method='post'>";
                    echo "<table>";
                    echo "<tr><th></th><th>會員ID</th><th>會員姓名</th><th>會員生日</th><th>會員信箱</th><th>手機號碼</th><th>會員性別</th><th>選擇的方案</th></tr>";
                    if (mysqli_num_rows($result_1) > 0) {
                        while($row = mysqli_fetch_assoc($result_1)) {
                            $gender = $row["gender"] === "male" ? "男" : "女";
                            echo "<tr><td><input class='check' type='checkbox' name='delete[]' value='" . $row["member_name"] . "'></td><td>" . $row["member_id"] . "</td><td>" . $row["member_name"] . "</td><td>" . $row["birthday"] ."</td><td>" . $row["gmail"] ."</td><td>". $row["phone"] ."</td><td>" . $gender ."</td><td>". $row["plan_id"] ."</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>沒有結果</td></tr>";
                    }
                    echo "</table>";
                    echo "<br/>";
                    echo "<input class='delete' type='submit' value='刪除'>";
                    echo "</form>";

                    if(isset($_POST['delete'])){
                        foreach ($_POST['delete'] as $name){
                            $sql = "DELETE FROM regular_member WHERE member_name = '$name'";
                            mysqli_query($link, $sql);
                        }
                        echo '<script>alert("刪除成功！");</script>';
                        echo '<script>alert("會員資料更新中！");</script>';
                        echo '<script>location.href = "manager_page.php";</script>';
                    }
                    mysqli_close($link);
                ?>
            </div>
            <!-- 手動新增區 -->
            <div class="boxes box_2" id = "box_2"> 
                <h3>新增會員資料</h3>
                <div id = "the_back_4">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p class = "input_bar">
                        會員ID：<input type="text" name="member_id"></p>
                    <p class = "input_bar">
                        會員姓名：<input type="text" name="member_name"></p>
                    <p class = "input_bar">
                        會員帳號：<input type="text" name="member_account"></p>
                    <p class = "input_bar">
                        會員密碼：<input type="text" name="password"></p>
                    <p class = "input_bar">
                        會員生日：<input type="date" name="birthday"></p>
                    <p class = "input_bar">
                        會員信箱：<input type="text" name="gmail"></p>
                    <p class = "input_bar">
                        會員手機：<input type="text" name="phone"></p>
                    <p class = "input_bar">
                        會員性別：
                        <label><input type="radio" name="gender" value="male">男</label>
                        <label><input type="radio" name="gender" value="female">女</label></p>
                    <input id = "log_in_bt" type="submit" value="新增會員" name = "submit">             
                    </form>
                </div>
                <?php
                    if(isset($_POST['submit'])){
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        if(!$link){
                            die('資料庫連線失敗！'.mysqli_connect_error());
                        }
                        $id = $_POST['member_id'];
                        $name = $_POST['member_name'];
                        $account = $_POST['member_account'];
                        $pw = $_POST['password'];
                        $birth = $_POST['birthday'];
                        $gmail = $_POST['gmail'];
                        $phone = $_POST['phone'];
                        $gender = $_POST['gender'];

                        $query = "SELECT * FROM regular_member WHERE member_id='$id'";
                        $result = mysqli_query($link, $query);

                        if(mysqli_num_rows($result) > 0){ 
                            echo '<script>alert("該會員已經存在或ID重複！");</script>';
                        }
                        else{ 
                            $sql="INSERT INTO regular_member(member_id, member_name, member_account, password, birthday, gmail, phone, gender) VALUES('$id','$name','$account','$pw','$birth','$gmail', '$phone','$gender')";
                            if(mysqli_query($link,$sql)){
                                echo '<script>alert("新增成功！");</script>';
                                echo '<script>alert("會員資料更新中！");</script>';
                            }else{
                                echo '<script>alert("無法新增資料！😭😭");</script>';
                            }
                        }
                        mysqli_close($conn);
                    }
                ?>
            </div>   
            <!-- 課程管理總覽     -->
            <div class="boxes box_3" id = "box_3">
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    $sql = "SELECT bookings.id, bookings.booking_date, bookings.member_account, regular_member.member_name, regular_member.phone FROM bookings JOIN regular_member ON bookings.member_account = regular_member.member_account";
                    $result_1 = mysqli_query($link, $sql);
                    echo "<h2 style='text-align:center;'>課程管理</h2>";
                    echo "<form action='' method='post'>";
                    echo "<table>";
                    echo "<tr><th>預定編號</th><th>會員帳號名稱</th><th>會員姓名</th><th>會員電話</th><th>課程預定日期</th></tr>";
                    if (mysqli_num_rows($result_1) > 0) { 
                        while($row = mysqli_fetch_assoc($result_1)) {           
                        echo "<tr><td>" . $row["id"]."</td><td>" . $row["member_account"] . "</td><td>". $row["member_name"] . "</td><td>". $row["phone"] . "</td><td>" . $row["booking_date"] ."</td></tr>";              
                        }
                    } else {
                        echo "<tr><td colspan='5'>沒有結果</td></tr>";
                    }
                    echo "</table>";
                    echo "</form>";
                ?>
                
            </div>  
            <!-- 方案管理總覽 -->
            <div class="boxes box_4"  id = "box_4">
            <h2 style="text-align:center;">方案管理</h2>
            <?php
                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql = "SELECT 
                            plan_id, 
                            COUNT(*) AS count
                        FROM 
                            plan_choose
                        WHERE 
                            plan_id IN ('新手方案', '進階方案', '達人方案')
                        GROUP BY plan_id;";
                $result_1 = mysqli_query($link, $sql);
                echo "<form action='' method='post'>";
                    echo "<table>";
                    echo "<tr><th>方案名稱</th><th>選擇此方案的人數</th></tr>";
                    if (mysqli_num_rows($result_1) > 0) { 
                        while($row = mysqli_fetch_assoc($result_1)) {           
                        echo "<tr><td>". $row["plan_id"] . "</td><td>" . $row["count"] ."</td></tr>";              
                        }
                    } else {
                        echo "<tr><td colspan='2'>沒有結果</td></tr>";
                    }
                    echo "</table>";
                    echo "</form>";
            ?>
            </div>
            <!-- 匯入批量資料 -->
            <div class="boxes box_5"  id = "box_5">
                <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <label for="csvfile">請選擇CSV檔案以匯入資料：</label>
                    <input type="file" name="csvfile" id="csvfile" required>
                    <input type="submit" value="匯入會員資料">
                </form>

                <script>
                    function validateForm() {
                        var fileInput = document.getElementById("csvfile");
                        if (fileInput.files.length === 0) {
                            alert("請選擇要匯入的CSV檔案！");
                            return false; 
                        }
                        return true;
                    }
                </script>
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $file = $_FILES["csvfile"]["tmp_name"];
                        $handle = fopen($file, "r");
                        $fileName = $_FILES["csvfile"]["name"];
                        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        if ($fileExt !== 'csv') {
                            echo '<script>alert("請選擇一個CSV檔案！");</script>';
                            fclose($handle);
                            exit();
                        }

                        fgetcsv($handle);

                        $success = false;

                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $id = $data[0];
                            $name = $data[1];
                            $account = $data[2];
                            $pw = $data[3];
                            $birth = $data[4];
                            $gmail = $data[5];
                            $phone = $data[6];
                            $gender = $data[7];

                            $sql = "INSERT INTO regular_member(member_id, member_name, member_account, password, birthday, gmail, phone, gender) VALUES('$id','$name','$account','$pw','$birth','$gmail', '$phone','$gender')";
                            if(mysqli_query($link,$sql)){
                                $success = true;                             
                            }else{
                                $fail = true;
                            }
                        }
                        fclose($handle);
                        if($success){
                            echo '<script>alert("新增成功！");</script>';
                        }
                    
                        if($fail){
                            echo '<script>alert("無法新增資料！😭😭");</script>';
                        }
                    }
                ?>
            </div>
            
            
        </div>
        
        <script>
            function showPageA(boxId, btID) {
                var boxes = document.getElementsByClassName('boxes');
                for (var i = 0; i < boxes.length; i++) {
                    boxes[i].style.display = 'none';
                }
                document.getElementById(boxId).style.display = 'flex';
            }
            function showPageB(boxId, btID) {
                var boxes = document.getElementsByClassName('boxes');
                for (var i = 0; i < boxes.length; i++) {
                    boxes[i].style.display = 'none';
                }
                document.getElementById(boxId).style.display = 'block';
            }
        </script>

    </body>
</html>