<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>管理員登入頁面</title>
        <link rel = "stylesheet" href = "./CSS/board2.css" />
        <link rel = "stylesheet" href = "./CSS/manager_login_page.css" />
        <link rel="icon" href="./pics/JAB.png" type="image/x-icon" />
    </head>
    <body>
        <div class = "background" >
            <div class = "backstage" >
            <div class = "head">
                    <input class = "redirect" id = "manager_login_part" type="button" value="管理員登入頁面">
                </div>
                <div id = "the_back_4">
                    <form method="post" action="manager_log_procedure.php">
                    <p class = "input_bar">
                        帳號：<input type="text" name="manager_account"></p>
                    <p class = "input_bar">
                        密碼：<input type="password" name="password"></p>
                    <input class = "bt1" id = "log_in_bt" type="submit" value="管理員登入" name = "submit">
                    <input class = "bt2" id = "back_bt" type="button" value="訪客瀏覽" onclick = "location.href = 'index.php'">
                    </form>
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>