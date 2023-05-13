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
        
                <input id = "index_bt" type="button" value="健身房" onclick = "location.href = 'index.php'">
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
       </div>

           
             <section>
            <div class="container">
             <span id="previous">＜</span>
             <span id="next">＞</span>
             <div id="slider" class="slider">
             <img src="./pics/coach_a.jpg"  />
             <img src="./pics/coach_aa.jpg"  />
             <img src="./pics/coach_aaa.jpg" />
             <img src="./pics/coach_aaaa.jpg" />
             <img src="https://fakeimg.pl/600x300/00ffff/" />
             </div>
             <ul id="dots" class="dots">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              </ul>
            </div>
            </section>

            <br>
        <div id="A_photo">
        <img src="./pics/Mickey.png" width=250/>
        </div>
        <div class="intro_A">
        <span style="font-size:28px;font-weight:bold;">初級教練(1)</span>
        <br>
        <br>
        <span style="font-size:20px;font-style:oblique;">姓名:</span>
        <span style="font-size:20px;">Mickey</span>
        <br>
        <span style="font-size:20px;font-style:oblique;">專長:</span>
        <span style="font-size:20px;">家教</span>
        </div>

        <div id="B_photo">
        <img src="./pics/2.png" width=250/>
        </div>
        <div class="intro_B">
        <span style="font-size:28px;font-weight:bold;">初級教練(2)</span>
        <br>
        <br>
        <span style="font-size:20px;font-style:oblique;">姓名:</span>
        <span style="font-size:20px;">Cuber</span>
        <br>
        <span style="font-size:20px;font-style:oblique;">專長:</span>
        <span style="font-size:20px;">當社長</span>
        </div>
        <div id="C_photo">
        <img src="./pics/3.png" width=250/>
        </div>
        <div id="E_photo">
        <img src="./pics/5.png" width=250/>
        </div>
        

      </div>
  
  <script>
    const nextEl = document.getElementById("next");
  const previousEl = document.getElementById("previous");
  const sliderEl = document.getElementById("slider");
  const dots = document.getElementById("dots");
  const imgCounts = sliderEl.children.length;
  nextEl.addEventListener("click", () => (slideProxy.index += 1));
  previousEl.addEventListener("click", () => (slideProxy.index -= 1));
  setClickEventToDots();
  window.onresize = debounce(calculateWidth);
  const slideProps = { index: 0 };
  const slideHandler = {
    set(obj, prop, value) {
      if (prop === "index") {
        if (value < 0 || value >= imgCounts) return;
        setDotToInactive();
        obj[prop] = value;
        calculateWidth();
        setActiveDot();
      }
    },
  };
  const slideProxy = new Proxy(slideProps, slideHandler);
  setActiveDot();
  function calculateWidth() {
    const imgWidth = sliderEl.offsetWidth;
    const recomputedWidth = slideProps.index * imgWidth;
    sliderEl.scrollLeft = recomputedWidth;
  }
  function setDotToInactive() {
    const { index } = slideProps
    dots.children[index].classList.remove('dot--active')
  }
  function setActiveDot() {
    const { index } = slideProps
    dots.children[index].classList.add('dot--active')
  }
  function setClickEventToDots() {
    for (let i = 0; i < dots.children.length; i++) {
      const li = dots.children[i]
      li.addEventListener('click', () => {
        slideProxy.index = i
      })
    }
  }
  function debounce(func, timeout = 100) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => {
        func.apply(this, args);
      }, timeout);
    };
  }
    </script>

       
    </body>
</html>