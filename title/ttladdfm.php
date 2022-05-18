<?php include '../leftmenu.php'; ?>
<h1>title add form</h1>

<?php
include '../connect.php';
echo "<form name=\"ttladdfm\" action=\"ttladdpt.php\" method=\"post\"><table><tr><td>artist</td><td>";
$sql = "select id,fnfullname(id,1) artist from artist order by concat(lastname,bandname)";
echo "<select name=\"artist\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\"";
	if ($row['id']==$_GET['id']) {
	  echo "selected >";
	} else {
	  echo ">";
	}
	echo $row['artist'];
}
echo "</select></td></tr>
<tr><td>prefix</td><td><input name=\"prefix\"></input></td></tr>
<tr><td>title</td><td><input name=\"title\"></input></td></tr>
<tr><td>first released</td><td><input name=\"frstrlsd\"></input></td></tr>
<tr><td>compilation</td><td><input name=\"cmpltn\" type=\"checkbox\"></input></td></tr>
<tr><td align=\"center\"colspan=\"2\"><input type=\"submit\"></input></td></tr>
<?php include '../includes/ttlselct.php'; ?>
</table></form>";
include '../sitemap.php';
?>
