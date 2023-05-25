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
       </div>

            <br>
        <div id="A_photo">
        <img class="coach_photo" src="./pics/Mickey.png" width=250/>
        </div>
        <div class="intro_A">
          <p >初級教練:Mickey(瑜珈)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        大家好！我是你們的健身教練。很高興有機會與你們一起努力追求健康和健美的目標。

我叫Mickey，是一位經驗豐富的健身教練。我在這個領域已經工作了1年，並且擁有相關的專業證書和執照。

我的熱情和興趣於健身運動始於多年前。我相信健康的身體是一個健康心靈的基石。通過適當的運動和訓練，我們可以提高體力、增強肌肉力量、改善體能和塑造更健美的身材。我致力於幫助每位學員實現他們的健身目標，並且享受健身過程中的樂趣和成就感。

作為你們的健身教練，我將根據你個人的需求和目標，制定一個量身定制的訓練計劃。我將結合不同的運動方式，包括有氧運動、力量訓練、柔軟度和平衡訓練等，確保你得到全面的身體鍛煉。

除了提供專業的訓練指導，我還將注重教育和激勵。我會向你解釋每個動作的正確執行方法、訓練的科學原理和鍛煉的注意事項。同時，我會給予你鼓勵和支持，幫助你克服困難並保持動力。

我非常期待與你一起工作，一起攜手打造一個更健康、更強壯和更自信的自己。無論你是初學者還是有經驗的運動員，我都會全力支持你，確保你在健身旅程中獲得最佳的成果。

如果你有任何問題或需要任何幫助，請隨時向我提問。讓我們一起開始這個充滿挑戰和成就的健身之旅吧！
</div>
        </div>

        <div id="B_photo">
        <img class="coach_photo" src="./pics/2.png" width=250/>
        </div>
        <div class="intro_B">
        <p >初級教練:Cuber(瑜珈)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        大家好！我是你們的健身教練。很高興有機會與你們一起努力追求健康和健美的目標。

我叫Cuber，是一位經驗豐富的健身教練。我在這個領域已經工作了1年，並且擁有相關的專業證書和執照。

我的熱情和興趣於健身運動始於多年前。我相信健康的身體是一個健康心靈的基石。通過適當的運動和訓練，我們可以提高體力、增強肌肉力量、改善體能和塑造更健美的身材。我致力於幫助每位學員實現他們的健身目標，並且享受健身過程中的樂趣和成就感。

作為你們的健身教練，我將根據你個人的需求和目標，制定一個量身定制的訓練計劃。我將結合不同的運動方式，包括有氧運動、力量訓練、柔軟度和平衡訓練等，確保你得到全面的身體鍛煉。

除了提供專業的訓練指導，我還將注重教育和激勵。我會向你解釋每個動作的正確執行方法、訓練的科學原理和鍛煉的注意事項。同時，我會給予你鼓勵和支持，幫助你克服困難並保持動力。

我非常期待與你一起工作，一起攜手打造一個更健康、更強壯和更自信的自己。無論你是初學者還是有經驗的運動員，我都會全力支持你，確保你在健身旅程中獲得最佳的成果。

如果你有任何問題或需要任何幫助，請隨時向我提問。讓我們一起開始這個充滿挑戰和成就的健身之旅吧！
</div>
        </div>
        <div id="C_photo">
        <img class="coach_photo" src="./pics/3.png" width=250/>
        </div>

        <div class="intro_C">
        <p >初級教練:Marker(飛輪)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        大家好！我是你們的健身教練。很高興有機會與你們一起努力追求健康和健美的目標。

我叫Mickey，是一位經驗豐富的健身教練。我在這個領域已經工作了1年，並且擁有相關的專業證書和執照。

我的熱情和興趣於健身運動始於多年前。我相信健康的身體是一個健康心靈的基石。通過適當的運動和訓練，我們可以提高體力、增強肌肉力量、改善體能和塑造更健美的身材。我致力於幫助每位學員實現他們的健身目標，並且享受健身過程中的樂趣和成就感。

作為你們的健身教練，我將根據你個人的需求和目標，制定一個量身定制的訓練計劃。我將結合不同的運動方式，包括有氧運動、力量訓練、柔軟度和平衡訓練等，確保你得到全面的身體鍛煉。

除了提供專業的訓練指導，我還將注重教育和激勵。我會向你解釋每個動作的正確執行方法、訓練的科學原理和鍛煉的注意事項。同時，我會給予你鼓勵和支持，幫助你克服困難並保持動力。

我非常期待與你一起工作，一起攜手打造一個更健康、更強壯和更自信的自己。無論你是初學者還是有經驗的運動員，我都會全力支持你，確保你在健身旅程中獲得最佳的成果。

如果你有任何問題或需要任何幫助，請隨時向我提問。讓我們一起開始這個充滿挑戰和成就的健身之旅吧！
</div>
          </div>

        <div id="D_photo">
        <img class="coach_photo" src="./pics/4.png" width=250/>
        </div>

        <div class="intro_D">
        <p >初級教練:陳班長(有氧)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        大家好！我是你們的健身教練。很高興有機會與你們一起努力追求健康和健美的目標。

我叫Mickey，是一位經驗豐富的健身教練。我在這個領域已經工作了1年，並且擁有相關的專業證書和執照。

我的熱情和興趣於健身運動始於多年前。我相信健康的身體是一個健康心靈的基石。通過適當的運動和訓練，我們可以提高體力、增強肌肉力量、改善體能和塑造更健美的身材。我致力於幫助每位學員實現他們的健身目標，並且享受健身過程中的樂趣和成就感。

作為你們的健身教練，我將根據你個人的需求和目標，制定一個量身定制的訓練計劃。我將結合不同的運動方式，包括有氧運動、力量訓練、柔軟度和平衡訓練等，確保你得到全面的身體鍛煉。

除了提供專業的訓練指導，我還將注重教育和激勵。我會向你解釋每個動作的正確執行方法、訓練的科學原理和鍛煉的注意事項。同時，我會給予你鼓勵和支持，幫助你克服困難並保持動力。

我非常期待與你一起工作，一起攜手打造一個更健康、更強壯和更自信的自己。無論你是初學者還是有經驗的運動員，我都會全力支持你，確保你在健身旅程中獲得最佳的成果。

如果你有任何問題或需要任何幫助，請隨時向我提問。讓我們一起開始這個充滿挑戰和成就的健身之旅吧！
</div>
          </div>

        <div id="E_photo">
        <img class="coach_photo" src="./pics/5.png" width=250/>
        </div>
        <div class="intro_E">
        <p >初級教練:黃教練(飛輪)</p>
          <br>
        <div style="width:300px;height: 200px; overflow:scroll  ; background:rgba(238,207,180,1);">
        大家好！我是你們的健身教練。很高興有機會與你們一起努力追求健康和健美的目標。

我叫Mickey，是一位經驗豐富的健身教練。我在這個領域已經工作了1年，並且擁有相關的專業證書和執照。

我的熱情和興趣於健身運動始於多年前。我相信健康的身體是一個健康心靈的基石。通過適當的運動和訓練，我們可以提高體力、增強肌肉力量、改善體能和塑造更健美的身材。我致力於幫助每位學員實現他們的健身目標，並且享受健身過程中的樂趣和成就感。

作為你們的健身教練，我將根據你個人的需求和目標，制定一個量身定制的訓練計劃。我將結合不同的運動方式，包括有氧運動、力量訓練、柔軟度和平衡訓練等，確保你得到全面的身體鍛煉。

除了提供專業的訓練指導，我還將注重教育和激勵。我會向你解釋每個動作的正確執行方法、訓練的科學原理和鍛煉的注意事項。同時，我會給予你鼓勵和支持，幫助你克服困難並保持動力。

我非常期待與你一起工作，一起攜手打造一個更健康、更強壯和更自信的自己。無論你是初學者還是有經驗的運動員，我都會全力支持你，確保你在健身旅程中獲得最佳的成果。

如果你有任何問題或需要任何幫助，請隨時向我提問。讓我們一起開始這個充滿挑戰和成就的健身之旅吧！
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