<?php
if (isset($_COOKIE["manager_name"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['manager_name'];
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
        <link rel = "stylesheet" href = "./CSS/index.css" />
    </head>
    <body>
        <div id = "background">
            <div id = "banner">
                <input id = "index_bt" style="font-size:34px;float:center;cursor:pointer"type="button" value="健身房" onclick = "location.href = 'index.php'">
                <?php
            if ($log_check == 0)
            {
                header("location:index.php");
            }
            else
            {
                ?>
                <p>連線成功</p>
                <input id = "logout_bt" type="button" value="登出" onclick = "location.href = 'manager_login_page.php'">
                <input id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'manager_change_page.php'">
            <?php
            }
            ?>
            </div>
            <div style="color:red;text-align:center"class="box_1">
                <h3 style="color:blue">會員總覽</h3>
                <hr/>
                <?php
                    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    //$link = require_once "configure.php";
                    $sql = "SELECT * FROM regular_member";
                    $result_1 = mysqli_query($link, $sql);
                    echo "<table>";
                    echo "<tr><th>會員ID</th><th>會員姓名</th><th>會員生日</th><th>會員信箱</th><th>會員性別</th></tr>";
                    if (mysqli_num_rows($result_1) > 0) {
                        while($row = mysqli_fetch_assoc($result_1)) {
                            $gender = $row["gender"] === "male" ? "男" : "女";
                            echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["member_name"] . "</td><td>" . $row["birthday"] ."</td><td>" . $row["gmail"] ."</td><td>" . $gender ."</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>沒有結果</td></tr>";
                    }
                    echo "</table>";
                    mysqli_close($link);
                ?>

            </div>
            <!-- 手動新增區 -->
            <div class="box_2"> 
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
                        會員生日：<input type="text" value="YYYY-MM-DD"name="birthday"></p>
                    <p class = "input_bar">
                        會員信箱：<input type="text" name="gmail"></p>
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
                        $gender = $_POST['gender'];

                        $query = "SELECT * FROM regular_member WHERE member_id='$id'";
                        $result = mysqli_query($link, $query);

                        if(mysqli_num_rows($result) > 0){ 
                            echo '<script>alert("該會員已經存在或ID重複！");</script>';
                        }
                        else{ 
                            $sql="INSERT INTO regular_member(member_id, member_name, member_account, password, birthday, gmail, gender) VALUES('$id','$name','$account','$pw','$birth','$gmail','$gender')";
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

        </div>
    </body>
</html>