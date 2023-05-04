<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8"></meta><!--網頁編碼-->
        <title>會員資訊</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/index.css" />
    </head>
    <body>
        <div id = "background">
            <div class = "banner">             
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
                <input class = "bt" id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input class = "bt" id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
            </div>
            <div id = "section_1">
                <h2>這裡會有個頭貼</h2>
                <img style="width:200px"alt="BMW LOGO" id = "head_pic" src = "./pics/BMW_logo.png">
            </div>
            <div id = "section_2">
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>         
                <p class = "text_a" id = "class">已預約xxxx/xx/xx的課程</p>
                <p class = "text_a" id = "plan">目前正使用...方案</p>
                <br/><br/><br/>
                <img style="width:300px"alt="Gurobi最帥" id = "pic_a" src = "./pics/0426.png">
            </div>
        </div>
    </body>
</html>