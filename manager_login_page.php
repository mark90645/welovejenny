<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>管理員登入</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./c_ss/log_pages.css" />
    </head>
    <body>
        <div class = "background" >
            <div id = "top_bar"></div>
            <div class = "backstage" >
                <div id = "the_back_4">
                    <form method="post" action="manager_log_procedure.php">
                    <p class = "input_bar">
                        帳號：<input type="text" name="manager_name"></p>
                    <p class = "input_bar">
                        密碼：<input type="password" name="password"></p>
                    <input id = "log_in_bt" type="submit" value="管理員登入" name = "submit">
                    <input id = "back_bt" type="button" value="訪客瀏覽" onclick = "location.href = 'index.php'">
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>