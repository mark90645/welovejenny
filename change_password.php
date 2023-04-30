<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>修改密碼</title>
        <link rel = "stylesheet" href = "./c_ss/page.css" />
        <link rel = "stylesheet" href = "./c_ss/change.css" />
        <script>
        function validateCheck() {
            var y = document.forms["changeForm"]["new_password"].value;
            var z = document.forms["changeForm"]["password_check"].value;
            if(y.length<6){
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
            <div id = "top_bar"></div>
            <div class = "backstage">
                <div id = "the_back_4">
                    <form name="changeForm" method="post" action="change_password_procedure.php" onsubmit="return validateCheck()">
                        <p class = "input_bar">
                            輸入帳號：<input type="text" name="member_account"></p>
                        <p class = "input_bar">
                            輸入舊密碼：<input type="password" name="old_password"></p>
                        <p class = "input_bar">
                            輸入新密碼：<input type="password" name="new_password"></p>
                        <p class = "input_bar">
                            再次輸入新密碼：<input type="password" name="password_check"></p>
                        <input id = "change_bt" type="submit" value="我要修改" name = "submit">
                        <input id = "back_bt" type="button" value="返回瀏覽" onclick = "location.href = 'index.php'">
                    </form>
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>

