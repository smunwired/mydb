<?php include 'leftmenu.php'; ?>
<h1>modify booking type</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$sql = "select id,nm from bk_booking_type where id=" . $_GET["id"];
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"bktypmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td>name</td><td><input name=\"nm\" type=\"text\" value=\"" . $row['nm'] . "\"></input></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
<?php include 'includes/bk_links.php'; ?>

