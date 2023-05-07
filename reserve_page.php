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
    <link href="./CSS/calendar.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php
include "Calendar.php";
include "Booking.php";
include "BookableCell.php";
 
 
$booking = new Booking(
    'gym',
    '25.41.90.151:3306',
    'share',
    'ihaveabigdick'
);

$username = $_COOKIE["member_account"];
 
$bookableCell = new BookableCell($booking, $username);
 
$calendar = new Calendar();
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>
</body>
</html>

<?php echo "123456 booked " . $booking->countBookingDaysByUsername('123456') . " days.\n"; ?>