<?php include 'leftmenu.php'; ?>
<h1>flight add form</h1>

<?php
include 'connect.php';
echo "<form name=\"flghadf\" action=\"flghadp.php\" method=\"post\">
<table>
<!--
//<tr><td>carrier</td><td>";
//$sql = "select id,nm from fl_carrier order by 2";
//echo "<select name=\"carrier\"><option value=\"\">";
//foreach($conn->query($sql) as $row) {
//	echo "<option value=\"". $row['id'] . "\">";
//	echo $row['nm'];
//}
echo "</select></td></tr>
-->
<tr>
	<td>flight_no</td>
	<td><input name=\"nm\"></input></td>
</tr>";
echo "<tr><td>depart destination</td><td>";
$sql = "select id,cd,nm from bk_destination order by 2";
echo "<select name=\"dprtdst\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'];
}
echo "</select></td></tr>
<tr><td>depart time</td><td><input name=\"dprttm\"></input></td></tr>";
echo "<tr><td>arrival destination</td><td>";
$sql = "select id,cd,nm from bk_destination order by 2";
echo "<select name=\"arvldst\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'];
}
echo "</select></td></tr>
<tr><td>arrival time</td><td><input name=\"arvltm\"></input></td></tr>
<tr><td>operated by</td>";
$sql = "select id,nm from bk_carrier order by 2";
echo "<td><select name=\"opr\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
        echo "<option value=\"". $row['id'] . "\">";
        echo $row['nm'];
}
echo "</select></td></tr>
<tr><td align=\"center\"colspan=\"2\"><input type=\"submit\"></input></td></tr>
</table></form>";
include 'includes/bk_links.php';
?>
