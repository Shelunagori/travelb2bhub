<?php error_reporting(0);
$servername = "localhost";
$username = "wwwtrave_b2b";
$password = "qwert#65";
$dbname="wwwtrave_b2b";
// Create connection
$connection = mysql_connect('localhost', 'wwwtrave_b2b', 'qwert#65');
mysql_select_db($dbname);

$servername = $_SERVER['HTTP_HOST'];
if($servername=='localhost' OR $servername=='192.168.3.82' OR $servername=='192.168.3.52')
{
$siteurl = 'http://'.$servername.'/travelb2bhub/';
}else{
$siteurl = 'https://'.$servername.'/';
}
date_default_timezone_set('Asia/Kolkata');
$months_data = array("1"=>"January", "2"=>"February", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June", "7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
?>