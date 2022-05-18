<?php include 'leftmenu.php'; ?>
<h1>Modify Card</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$sql = "select * from card where id=" . $_GET["id"];
echo $sql;
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"crdmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td><input name=\"account_id\" type=\"hidden\" value=\"" . $row['account_id'] . "\"></input></td></tr>
	<tr><td>card number</td><td><input name=\"card_number\" type=\"text\" value=\"" . $row['card_number'] . "\"></input></td></tr>
	<tr><td>valid from</td><td><input name=\"valid_from\" type=\"text\" value=\"" . $row['valid_from'] . "\"></input></td></tr>
	<tr><td>expires</td><td><input name=\"expires\" type=\"text\" value=\"" . $row['expires'] . "\"></input></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
