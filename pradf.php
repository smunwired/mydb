<?php include 'leftmenu.php'; ?>
<h1>Add Paragraph</h1>

<?php
include 'connect.php';
echo "<table>";
	echo "<form method=\"post\"action=\"pradp.php\">
	<tr><td>date</td><td><input name=\"dt\" type=\"text\" value=\"" . date("Y-m-d") . "\"></input></td></tr>
	<tr><td>text</td><td><textarea rows=\"4\" cols=\"50\" name=\"txt\">" . $row['txt'] . "</textarea></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
echo "</table>";
?>
