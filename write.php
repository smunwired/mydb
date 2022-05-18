<?php include 'leftmenu.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$yr='0000';
$mn='00';
$myfile = fopen("2019.txt", "w") or die("Unable to open file!");
include 'connect.php';
$sql="select date_format(dt,'%Y') as yr,date_format(dt,'%M') as mn,dt,concat(date_format(dt,'%W'),\" \",date_format(dt,'%D')) as dy,txt,md from paragr where date_format(dt,'%Y') = '2019' order by dt";
foreach($conn->query($sql) as $row) {
  if ($yr!=$row['yr']){
    $yr=$row['yr'];
    fwrite($myfile,$yr . "\n");
  } 
  if ($mn!=$row['mn']){
    $mn=$row['mn'];
    fwrite($myfile,$mn . "\n");
  } 
  if ($dy=$row['dy']){
    $dy=$row['dy'];
    fwrite($myfile,$dy . "\n");
  }
  $txt = $row['txt'] . " " . $row['md'] . "\n";
  fwrite($myfile, $txt);
  
}
fclose($myfile);
print "written<rb/>";
?> 
