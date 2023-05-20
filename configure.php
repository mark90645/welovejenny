<?php

define('DB_SERVER', '25.41.90.151:3306');
define('DB_USERNAME', 'share');
define('DB_PASSWORD', 'ihaveabigdick');
define('DB_NAME', 'gym');
    
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// 輸入中文也OK的編碼
mysqli_query($link, 'SET NAMES utf8');

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
    return $link;
}
?>