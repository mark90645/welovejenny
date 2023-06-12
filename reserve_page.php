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

<html>
<head>
    <link rel="stylesheet" href="./CSS/calendar.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="./CSS/reserve_page.css">
    <link rel="icon" href="./pics/PH.png" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> -->
</head>
<body>
    <div class = "head_adjust"></div>
    <div class = "title_box">
        <p class = "title">目前課程: </p>
        <p class = "title2">瑜珈</p>
    </div>
    <div class = "change_box">
        <input class = "bt_2 go_page" id = "yoga_bt" type="button" value="瑜 珈 課 程" onclick = "location.href = 'reserve_page.php'">
        <div class = "line" id = "line1"></div>
        <input class = "bt_2 go_page" id = "bike_bt" type="button" value="飛 輪 課 程" onclick = "location.href = 'reserve_page2.php'">
        <div class = "line" id = "line2"></div>
        <input class = "bt_2 go_page" id = "aerobic_bt" type="button" value="有 氧 課 程" onclick = "location.href = 'reserve_page3.php'">
        <div class = "line" id = "line3"></div>
        <input class = "bt_2 back_page" id = "info_bt" type="button" value="會 員 資 訊" onclick = "location.href = 'member_info_page.php'">
        <div class = "line" id = "line4"></div>
        <input class = "bt_2 back_page" id = "index_bt" type="button" value="回 到 首 頁" onclick = "location.href = 'index.php'">
    </div>
<?php
include "Calendar.php";
include "Booking.php";
include "BookableCell.php";


$booking = new Booking(
    'gym',
    '25.41.90.151:3306',
    'share',
    'ihaveabigdick',
    'yoga'
);

$username = $_COOKIE["member_account"];
 
$bookableCell = new BookableCell($booking, $username, 'yoga');
 
$calendar = new Calendar('yoga');
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();

$booking->autoDelete();
?>
<div class = "info_box">
    <div class = "info_text">
        <?php echo "已預約 " . $booking->countBookingDaysByUsername($_COOKIE["member_account"]) . " 天\n"; ?>
    </div>
</div>
<img class = "motion_pic" src="./pics/yoga.png" />
</body>
</html>

