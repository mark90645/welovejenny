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
        <meta charset = "UTF-8"></meta>
        <title>健身房系統首頁</title>
        <link rel = "stylesheet" href = "./CSS/board.css" />
        <link rel = "stylesheet" href = "./CSS/index.css" />
    </head>
    <body>
        <div class = "background">
            <div>
            <img   id="gym_head_pic" src = "./pics/gym_head.jpg"/>
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
                <input class = "bt" id = "change_bt" type="button" value="修改個人資料" onclick = "location.href = 'change_password.php'">
                <?php
                }
                ?>
            </div>

            <div class="color-lump">          
            <div class="slideshow-container">
              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/c2/6a/87/c26a87129b59737f8c3435091810816a.jpg" style="width:100%;height:100%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/d1/d0/05/d1d0058fc64a07acba52c9bbfd2da7b5.jpg" style="width:100%;height:100%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/a0/e5/f6/a0e5f6bc70cf643be31be521f560885e.jpg" style="width:100%;height:100%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/d1/12/46/d112468ed2e1a0d8f5e0c60b6a1af042.jpg" style="width:100%;height:100%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/e8/38/22/e838229f1592b1552866c4f1857dbee2.jpg" style="width:100%;height:100%">
              </div>

              <a class="prev" onclick="plusSlides(-1)">❮</a>
              <a class="next" onclick="plusSlides(1)">❯</a>

              </div>
       

            <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
            <span class="dot" onclick="currentSlide(4)"></span> 
            <span class="dot" onclick="currentSlide(5)"></span> 
            </div>
            <script>
              var slideIndex = 0;
                showSlides();
                function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                      slides[i].style.display = "none";  
                    }
                    
                    if (slideIndex > slides.length-1) {slideIndex = 0}    
                    if (slideIndex < 0) {slideIndex = slides.length-1} 
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex].style.display = "block";  
                    dots[slideIndex].className += " active";
                    timeout=setTimeout(showSlides, 4000);
                    slideIndex++;
                    return timeout;
                  }

                  function plusSlides(n) {
                      clearTimeout(timeout);
                      slideIndex += n-1;
                      showSlides();
                    }
                    
                    function currentSlide(n) {
                      clearTimeout(timeout);
                      slideIndex = n;
                      showSlides();
                    }
            </script>             
            </div>


            <div class="color-lump-2"> <div class = "adjust_index">
                        <p class = "text_a" id = "cat_text"><b>方案內容介紹</b></p> 
                        <?php
                        if($log_check == 0)
                        {?>
                        <?php
                        }else{
                        ?> 
                        <input class = "bt_2" id = "reserve_bt" type="button" value="課程預約" onclick = "location.href = 'reserve_page.php'">
                        <input class = "bt_2" id = "reserve_bt" type="button" value="方案選擇" onclick = "location.href = 'plan_choose.php'">                         
                        <?php
                        }    
                        ?>
                    </div></div>
            <div class="color-lump-3">
            <div class = "adjust_index">
                    <?php
                        $conn=require_once "configure.php";
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        $sql = "SELECT * FROM plan_detail";
                        $result_plan = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result_plan) > 0) {
                            while($row = mysqli_fetch_assoc($result_plan)) {
                                echo "<p>".$row["plan_id"]." : "."<span>".$row["price"]."</span>"."</p>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>沒有結果</td></tr>";
                        }
                        mysqli_close($link);
                    ?>
                        <p class = "text_b" id = "dog">汪汪隊出任務</p>
                        <p class = "text_b" id = "dog_text">幾張教練照片</p>
                        <input class = "bt_2" id = "reserve_bt" type="button" value="教練簡介" onclick = "location.href = 'coach_page.php'">
                    </div>
            </div>
            
             

           
        </div>

        <div class = "end">
            <p>聯絡資訊</p>
            <input class = "contact_pic" id = "pic_c" type="button" onclick = "location.href = 'reserve_page.php'"><!--這裡我不會把圖案變按鈕 CSS大神救我-->
            <input class = "contact_pic" id = "pic_d" type="button" onclick = "location.href = 'reserve_page.php'"><img src = "./pics/instagram.png" id = "ig"></button>
        </div>


    </body>
</html>