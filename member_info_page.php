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
            <div id = "banner">
                <h2>這裡會有個頭貼</h2>
                <img style="width:200px"alt="BMW LOGO" id = "head_pic" src = "./pics/BMW_logo.png">             
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
                <input id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <input id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
            </div>
            <div id = "section_1">
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>         
                <p class = "text_a" id = "cat">喵喵喵</p>
                <p class = "text_a" id = "cat_text">會員資訊的東東 對。</p>
                <br/><br/><br/>
                <img style="width:300px"alt="Gurobi最帥" id = "pic_a" src = "./pics/0426.png">
            </div>
        </div>
    </body>
</html>