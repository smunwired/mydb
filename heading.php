<?php //include 'leftmenu.php'; ?>
<h1>heading</h1>
<table>
	<tr>
		<th>heading
		<th>display
		<th>width
		<th>height
		<td colspan="3" align="center"><a href="hdngadf.php">add</a></td>
	</tr>

<?php
include 'connect.php';
$sql="select * from heading";
foreach($conn->query($sql) as $row) {
  echo "<tr>
  	<td>" . $row['nm'] . "</td>
  	<td>" . $row['display'] . "</td>
  	<td>" . $row['image_width'] . "</td>
  	<td>" . $row['image_height'] . "</td>
  	<td>
  		<a href=\"imagelst.php?heading=" . $row['id'] . "\">list</a>
  		<a href=\"hdngmf.php?id=" . $row['id'] . "\">mod</a>
  		<a href=\"hdngdp.php?id=" . $row['id'] . "\">del</a>
  	</td>
  </tr>";
}
echo "</table>";
//include 'sitemap.php'
?>
