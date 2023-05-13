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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="switch">
        <div class="right" onclick="javascript:location.href='./reserve_page3.php'">
            <i class="bi bi-arrow-right"></i>
        </div>
        <div class="left" onclick="javascript:location.href='./reserve_page.php'">
            <i class="bi bi-arrow-left"></i>
        </div>
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
    '2'
);

$username = $_COOKIE["member_account"];
 
$bookableCell = new BookableCell($booking, $username, '2');
 
$calendar = new Calendar('2');
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>
<?php echo "you booked " . $booking->countBookingDaysByUsername($_COOKIE["member_account"]) . " days.\n"; ?>
    <div class="prev_page" onclick="javascript:location.href='./index.php'">
        <i class="bi bi-arrow-left"></i>
    </div>
</body>
</html>