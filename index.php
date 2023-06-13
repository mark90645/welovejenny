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
        <link rel="icon" href="./pics/誼.png" type="image/x-icon" />
    </head>
    <body>
        <div class = "background">
            <div>
            <img id="gym_head_pic" src = "./pics/gym_head.png"/>
                <input id = "index_bt" type="button" value="回到首頁" onclick = "location.href = 'index.php'">
                <?php
                if ($log_check == 0)
                {
                ?>
                <input class = "bt" id = "log_bt" type="button" value="登入" onclick = "location.href = 'log_in_page.php'">
                <input class = "bt" id = "sign_bt" type="button" value="註冊" onclick = "location.href = 'sign_up_page.php'">
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
              <img src="https://i.pinimg.com/564x/c2/6a/87/c26a87129b59737f8c3435091810816a.jpg" style="width:100%;height:100%; margin-top:-10%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/d1/d0/05/d1d0058fc64a07acba52c9bbfd2da7b5.jpg" style="width:100%;height:100%; margin-top:-10%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/a0/e5/f6/a0e5f6bc70cf643be31be521f560885e.jpg" style="width:100%;height:100%; margin-top:-5%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/d1/12/46/d112468ed2e1a0d8f5e0c60b6a1af042.jpg" style="width:100%;height:100%; margin-top:-5%">
              </div>

              <div class="mySlides fade">
              <img src="https://i.pinimg.com/564x/e8/38/22/e838229f1592b1552866c4f1857dbee2.jpg" style="width:100%;height:100%; margin-top:-10%">
              </div>

              <a class="prev" onclick="plusSlides(-1)">❮</a>
              <a class="next" onclick="plusSlides(1)">❯</a>

              </div>
                <br>

            <div style="margin-left:580px">
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


            <div class="color-lump-2"> 
                <div class = "adjust_index_2">
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
                        
                    <div class="tabs">
            <ul class="tabs__list">
            <li class="tabs__tab">
            <input class="tabs__input" type="radio" id="tab-0" name="tab-group" checked>
             <label for="tab-0" class="tabs__label" tabindex="0" role="button">新手方案</label>
            <div class="tabs__content">
                <b>新手方案 / 期間: 6 months / 價格:4799 </b><br><br>
            這個方案是針對初學者而設計的。在半年的計畫內，您將得到健身教練的協助，讓您更了解運動的方法與技巧，以及如何更好地達到自己的健身目標。此外，您可以享受到健身房內的各項設施，包括器械設備、瑜珈、舞蹈、有氧運動等，並且可以參加由健身房舉辦的各種健身課程。
             </div>
             </li>
             <li class="tabs__tab">
           <input class="tabs__input" type="radio" id="tab-1" name="tab-group">
           <label for="tab-1" class="tabs__label" tabindex="0" role="button">進階方案</label>
           <div class="tabs__content">
           <b>進階方案 / 期間: 12 months / 價格:8799 </b><br><br>
           這個方案是針對那些已經有一定運動基礎，且希望長期投資自己身體的人而設計的。在一年的計畫內，您可以享受到健身房內各項設施的使用權，同時也可以參加健身房舉辦的各種健身課程。此外，我們也為您安排了專屬的健身教練，讓您可以更有效率地達成自己的健身目標。
          </div>
         </li>
         <li class="tabs__tab">
           <input class="tabs__input" type="radio" id="tab-2" name="tab-group">
           <label for="tab-2" class="tabs__label" tabindex="0" role="button">達人方案</label>
           <div class="tabs__content">
           <b>達人方案 / 期間: 24 months / 價格:12999 </b><br><br>
           這個方案是針對那些對健身非常投入，且希望持續挑戰自己的人而設計的。在兩年的計畫內，您可以享受到健身房內各項設施的使用權，同時也可以參加健身房舉辦的各種健身課程。此外，我們也為您安排了專屬的健身教練，讓您可以更有效率地達成自己的健身目標。同時，我們也會定期為您舉辦健身比賽或挑戰賽，讓您有機會和其他健身達人切磋技藝，提升自己的健身水平。
          </div>
         </li>
        </ul>
        </div>

                </div>
            </div>

            <div class="color-lump-3">
            <img id="peppa_pic" src = "./pics/peppa.png"/>
                <div class = "adjust_index_3">
                    <input class = "bt_2" id = "coach_bt" type="button" value="教練簡介" onclick = "location.href = 'coach_page.php'">
                    <br>    
                </div>
                
            </div>
        </div>
       </div>

        <div class = "end">
            <img class = "email_pic" src = "./pics/email.png"/>
            <p class = "email_text">email : 5huameat@gmail.com</p>
            <img class = "fb_pic" src = "./pics/facebook.png"/>
            <p class = "fb_text">facebook : </p>
            <a class = "fb_link" href="https://www.facebook.com/profile.php?id=100007760377475" target=_blank>五花肉運動會館</a>
            <div class = "end_line3"></div>
            <img class = "phone_pic" src = "./pics/phone.png"/>
            <p class = "phone_text">phone : (02)2940-6086</p>
            <img class = "house_pic" src = "./pics/house.png"/>
            <p class = "house_text">address : 新竹市東區大學路1001號游泳館2樓</p>
            <input class = "sp_bt privacy" type="button" value="隱私權政策" target=_blank onclick = "location.href = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'">
            <div class = "end_line1"></div>
            <input class = "sp_bt user" type="button" value="使用者條款" target=_blank onclick = "location.href = 'https://www.youtube.com/watch?v=w0AOGeqOnFY'">
            <div class = "end_line2"></div>
            <?php
                if ($log_check == 0)
                {
                ?>
                <input class = "sp_bt manager" type="button" value="管理員登入" onclick = "location.href = 'manager_login_page.php'">
                <?php
                }
                ?>
        </div>
    </body>
</html>