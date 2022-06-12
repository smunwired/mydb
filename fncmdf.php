<?php include 'leftmenu.php'; ?>
<h1>Modify Fence</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$sql = "select * from fence where id=" . $_GET["id"];

echo "<table>";
foreach($conn->query($sql) as $row) {
	echo $row['lesson'];
	if ($row['lesson']==0) {$lsn = "";} else {$lsn = "checked";} echo $lsn;
	echo "<form method=\"post\"action=\"fncmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td>date</td><td><input name=\"dt\" type=\"text\" value=\"" . $row['dt'] . "\"></input></td></tr>
	<tr><td>venue</td><td><textarea rows=\"4\" cols=\"50\" name=\"venue\">" . $row['venue'] . "</textarea></td></tr>
	<tr><td>lesson</td><td><input type=\"checkbox\" name=\"lesson\" " . $lsn . "></input></td></tr>
	<tr><td>text</td><td><textarea rows=\"4\" cols=\"50\" name=\"txt\">" . $row['txt'] . "</textarea></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
    </form>";
}
echo "</table>";
?>
