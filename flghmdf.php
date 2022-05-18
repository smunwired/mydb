<?php include 'leftmenu.php'; ?>
<h1>Modify Flight</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$sql = "select * from bk_flight where id=" . $_GET["id"];
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"flghmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td>flight_no</td><td><input name=\"nm\" type=\"text\" value=\"" . $row['nm'] . "\"></input></td></tr>";
	$dest="select id,nm from bk_destination order by 2";
        echo "<tr><td>departing from</td><td><select name=\"dpdst\">
        <option value=\"\">";
        foreach($conn->query($dest) as $row1) {
		if ($row1['id']==$row['dpdst']) {
        		echo "<option value=\"". $row1['id'] . "\" selected>" . $row1['nm'];
		} else {
        		echo "<option value=\"". $row1['id'] . "\" >" . $row1['nm'];
		}
        }
        echo "</select></td></tr>
	<tr><td>departure time</td><td><input name=\"dptm\" type=\"text\" value=\"" . $row['dptm'] . "\"></input></td></tr>";
	$dest="select id,nm from bk_destination order by 2";
        echo "<tr><td>arriving at</td><td><select name=\"ardst\">
        <option value=\"\">";
        foreach($conn->query($dest) as $row2) {
		if ($row2['id']==$row['ardst']) {
        		echo "<option value=\"". $row2['id'] . "\" selected>" . $row2['nm'];
		} else {
        		echo "<option value=\"". $row2['id'] . "\" >" . $row2['nm'];
		}
        }
        echo "</select></td></tr>
	<tr><td>arrival time</td><td><input name=\"artm\" type=\"text\" value=\"" . $row['artm'] . "\"></input></td></tr>
	<tr><td>seats</td><td><input name=\"seats\" type=\"text\" value=\"" . $row['seats'] . "\"></input></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
