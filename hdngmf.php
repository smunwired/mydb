<?php //include 'leftmenu.php'; ?>
<h1>heading modify form</h1>
<table>
<?php
include 'connect.php';
$sql="select * from heading where id=\"" . $_GET['id'] . "\"";//echo $sql;
foreach($conn->query($sql) as $row) {
  echo "<form name=\"hdngmf\" method=\"get\" action=\"hdngmp.php\"><input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\" />
  	<tr><td>heading</td><td><input name=\"hdng\" value=\"" . $row['nm'] . "\" /></td></tr>
  	<tr><td>display</td><td><input name=\"dsply\" value=\"" . $row['display'] . "\" /></td></tr>
  	<tr><td>sequence</td><td><input name=\"dsplysq\" value=\"" . $row['display_seq'] . "\" /></td></tr>
  	<tr><td>width</td><td><input name=\"wd\" value=\"" . $row['image_width'] . "\" /></td></tr>
  	<tr><td>height</td><td><input name=\"ht\" value=\"" . $row['image_height'] . "\" /></td></tr>
  	<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\"></td></tr>
  </tr>";
}
echo "</table>";
//include 'sitemap.php'
?>
