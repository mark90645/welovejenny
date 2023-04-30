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
                    <form method="post" action="log_procedure.php">
                    <p class = "input_bar">
                        帳號：<input type="text" name="member_account"></p>
                    <p class = "input_bar">
                        gmail：<input type="text" name="gmail"></p>
                    <input id = "find_password_bt" type="submit" value="找回密碼" name = "submit">
                    <input id = "back_bt" type="button" value="返回" onclick = "location.href = 'log_in_page.php'">
                </div>
            </div>
            <div class = "end"></div>
        </div>
    </body>
</html>