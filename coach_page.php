<?php
if (isset($_COOKIE["member_account"]))
{
    $log_check = True;
    $conn=require_once "configure.php";
    $cookie = $_COOKIE['member_account'];
}
else
{
    $log_check = False;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--網頁編碼-->
        <title>教練簡介</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/coach_page.css" />
    </head>

    <body>
     <div class = "background" >
        <div class = "banner">
        
                <input id = "index_bt" type="button" value="回到首頁" onclick = "location.href = 'index.php'">
                <?php
            if ($log_check == 0)
            {
                ?>
                <input class = "bt" id = "log_bt" type="button" value="登入" onclick = "location.href = 'log_in_page.php'">
                <input class = "bt" id = "sign_bt" type="button" value="註冊" onclick = "location.href = 'sign_up_page.php'">
                <input class = "bt" id = "manager_bt" type="button" value="管理員登入" onclick = "location.href = 'manager_login_page.php'">
            <?php
            }
            else
            {
                ?>
                <input class = "bt" id = "mem_info_bt" type="button" value="會員資訊" onclick = "location.href = 'member_info_page.php'">
                <input class = "bt" id = "logout_bt" type="button" value="登出" onclick = "location.href = 'log_out.php'">
                <input class = "bt" id = "change_bt" type="button" value="修改密碼" onclick = "location.href = 'change_password.php'">
                <input class = "bt" id = "change_bt" type="button" value="回到首頁" onclick = "location.href = 'index.php'">
            <?php
            }
            ?>
<<<<<<< Updated upstream
       </div>

            <br>
        <div id="A_photo">
        <img class="coach_photo" src="./pics/Mickey.png" width=250/>
        </div>
        <div class="intro_A">
          <p >高級教練:Mickey(瑜珈)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        Mickey教練，來自陽明交通大學運管系，是本健身房的少女殺手，以其英俊的外貌與柔軟的身段聞名，在教課期間擄獲了不少女學員的芳心，除了瑜珈教學外，Mickey教練也是名專業的POPPING舞蹈者，曾代表陽明交大參與熱舞梅竹賽，在場上發光發熱，除了瑜珈和熱舞外，Mickey教練在校成績非常卓越屢次獲得書卷獎，可說是多才多藝、允文允武，如果你也想一睹Mickey老師那迷人的風采，那就趕快來報名平日的瑜珈課程吧！
</div>
        </div>

        <div id="B_photo">
        <img class="coach_photo" src="./pics/2.png" width=250/>
        </div>
        <div class="intro_B">
        <p >高級教練:Cuber(瑜珈)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        Cuber教練，aka 「AGENT FONG」，來自陽明交通大學運管系，擁有四年的豐富健身經驗，除此之外Cuber教練也曾接觸過足球、網球、排球等球類運動，是多功能型運動選手，運動經驗相當豐富，除了瑜珈教學外，Cuber教練同時也是魔術方塊社社長，來上課還能順便教你魔術方塊，其中一項教學特色便是讓你學會邊做瑜珈邊解出魔術方塊！想邊運動邊學習獨一無二的酷炫才藝嗎？那就來報名平日的瑜珈課程吧！
</div>
        </div>
        <div id="C_photo">
        <img class="coach_photo" src="./pics/3.png" width=250/>
        </div>

        <div class="intro_C">
        <p >中級教練:Marker(飛輪)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        Marker教練，來自陽明交通大學運管系，是名跑步與飛輪/單車的專家，跑步經驗豐富的他曾經和兩個女生約跑了整整兩學期，甚至常常騎著UBIKE滑下好漢坡！如此豐富的經驗造就了Marker教練強大心肺耐力，讓他無論在讀書還是運動都有堅強的耐力，除了跑步和飛輪以外，Marker教練也是名音樂才子，在管樂社擔任打擊並參與了多場演出，強大的節奏感讓他在跑步或踩飛輪時總是能找到穩定的配速，如果你也想和Marker教練學習，歡迎報名平日飛輪課程！
</div>
          </div>

        <div id="D_photo">
        <img class="coach_photo" src="./pics/4.png" width=250/>
        </div>

        <div class="intro_D">
        <p >高級教練:陳班長(有氧)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        陳班長教練，來自陽明交通大學運管系，擁有多年舞蹈經驗，舞蹈技巧已到了爐火純青的地步，平時除了愛吃以外也是名化妝品專家與成癮者，她能教你如何在跳舞時依然能保有美麗的妝容，還能推薦你各式各樣奇幻的化妝品，如果你是愛美的個性且樂於展現自己活潑的魅力，又想透過有氧運動保有苗條的身材，歡迎來報名陳班長獨家專開的有氧舞蹈課程！
</div>
          </div>

        <div id="E_photo">
        <img class="coach_photo" src="./pics/5.png" width=250/>
        </div>
        <div class="intro_E">
        <p >中級教練:黃小七(飛輪)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        黃小七教練，來自陽明交通大學運管系，是名蘋果牛奶的熱愛者，個性容易忘東忘西，他經常把錢包忘在奇怪的地方，還經常欠同學錢，能活到現在可說是非常勇猛，此外黃小七教練也是名樂觀開朗的教練，在學期間雖受到無數的霸凌卻仍能保有快樂天真的心，如果你心情不好，那就來報名黃小七教練的飛輪課程，一邊運動一邊感受樂觀快樂的氛圍，說不定他還會請你喝鶴茶樓喔！
</div>
          </div>
        

      </div>
      <div class = "end">
            <p>聯絡資訊</p>
            <input class = "contact_pic" id = "pic_c" type="button" onclick = "location.href = 'reserve_page.php'"><!--這裡我不會把圖案變按鈕 CSS大神救我-->
            <input class = "contact_pic" id = "pic_d" type="button" onclick = "location.href = 'reserve_page.php'"><img src = "./pics/instagram.png" id = "ig"></button>
        </div>
       
=======
            </div>
            <br>
           <div class = "grade_a">
             <p><strong>初級課程</p> 
             <p align ="middle">教練1</p> 
             <img src="./pics/coach_a.jpg" height="300" style="float:left" > 
             <p align ="middle">專長</p> 
          </div>
          
          <div class="intro_a">
          <ul style='list-style-type:upper-roman;'>
            <li >香蕉</li>
            <li>芭樂</li>
            <li>鳳梨</li>
            </ul>
          </div>  

        
    </div>      

>>>>>>> Stashed changes
    </body>
</html>