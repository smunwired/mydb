<?php include 'leftmenu.php'; ?>
<h1>Modify Paragraph</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$sql = "select * from paragr where id=" . $_GET["id"];
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"prmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td>date</td><td><input name=\"dt\" type=\"text\" value=\"" . $row['dt'] . "\"></input></td></tr>
	<tr><td>text</td><td><textarea rows=\"4\" cols=\"50\" name=\"txt\">" . $row['txt'] . "</textarea></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
