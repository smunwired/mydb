<?php include 'leftmenu.php';
include 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$directory = "/var/www/html/mydb/images/url";
$images = glob($directory . "/*.jpg");

foreach($images as $image)
{
  echo $image . "<br/><img src=\"" . substr($image,13)  . "\">";
}
?>
<br/><img src="/var/www/html/mydb/images/url/220px-Bowie_Box_Set_(Outside,_Earthling,_Hours,_Heathen,_Reality-_10CD).jpg">
<br/><img src="/mydb/images/url/220px-Bowie_Box_Set_(Outside,_Earthling,_Hours,_Heathen,_Reality-_10CD).jpg">

