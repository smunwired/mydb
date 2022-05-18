<?php include '../leftmenu.php'; ?>
<h1>Modify Title Medium</h1>

<?php
include '../connect.php';
$id = $_GET['id'];
$sql = "select t.title,tm.id,medium,release_year,label from title_medium tm join title t on t.id=tm.title where tm.id=" . $_GET["id"];
echo "<table>";
foreach($conn->query($sql) as $row) {
	echo "<form method=\"post\"action=\"ttlmdmdp.php\">
	<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
	<tr><td>title</td><td><input name=\"title\" type=\"text\" value=\"" . $row['title'] . "\"></input></td></tr>
	<tr><td>medium</td><td><select name=\"medium\">";
	$sql2="select * from medium";
    foreach($conn->query($sql2) as $row2) {
		if ($row['medium']==$row2['id']) {
		    echo "<option value=\"" . $row2['id'] . "\" selected>" . $row2['medium'];
	  } else {
		    echo "<option value=\"" . $row2['id'] . "\">" . $row2['medium'];
	  }
	}
	echo "</select></td></tr>
		<tr><td>release year</td><td><input name=\"release_year\" type=\"text\" value=\"" . $row['release_year'] . "\"></input></td></tr>
		<tr><td>label</td><td><input name=\"label\" type=\"text\" value=\"" . $row['label'] . "\"></input></td></tr>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
	    </form>";
	}
echo "</table>";
?>
