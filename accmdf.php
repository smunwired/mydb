<?php include 'leftmenu.php'; ?>
<h1>Modify Account</h1>

<?php
include 'connect.php';
$id = $_GET['accd'];
$sql = "select * from account where account_id=" . $_GET["accd"];
//echo $sql;
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"accmdp.php\">
	<tr><td><input name=\"accd\" type=\"hidden\" value=\"" . $row['account_id'] . "\"></input></td></tr>
	<tr><td>account name</td><td><input name=\"accn\" type=\"text\" value=\"" . $row['account_name'] . "\"></input></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
