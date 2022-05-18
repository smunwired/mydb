<?php include '../leftmenu.php'; ?>
<head><style>.floatright { float: left; }.floatleft { float: left; }</style></head>
<h2>title modify form</h2>
<?php
include '../connect.php';

$id = $_GET['id']; echo "<br/>" . $id . "<br/>";

#$sql = "select * from title where id=" . $_GET["id"];
$sql = "select * from title where id=" . $id;

    foreach($conn->query($sql) as $row) {
        echo "<div class=\"floatright\"><h3>title detail</h3><form method=\"post\" action=\"ttlmodpt.php\"><table>
		<tr><td><input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input></td></tr>
		<tr><td>artist id</td><td>" . $row['artist'] . "</td></tr>
		<tr><td>artist</td><td><select name=\"artist\">";
		$sql2 = "select id, fnfullname(id,1) artist,
			case length(lastname) when 0 then bandname else lastname end ordcol
			from artist
			order by ordcol";
		foreach($conn->query($sql2) as $row2) {
			if ($row['artist']==$row2['id']) {
			    echo "<option value=\"" . $row2['id'] . "\" selected>" . $row2['artist'];
	    	} else {
			    echo "<option value=\"" . $row2['id'] . "\">" . $row2['artist'];
	    	}
	    }
	}
	echo "
    </select></td></tr><tr><td>prefix</td><td><input name=\"prefix\" type=\"text\" value=\"" . $row['prefix'] . "\"></input></td></tr>
			<tr><td>title</td><td><input name=\"title\" type=\"text\" value=\"" . $row['title'] . "\"></input></td></tr>
			<tr><td>first released</td>
			<td><input name=\"first_released\" type=\"text\" value=\"" . $row['first_released'] . "\"></input></td></tr>
			<tr><td>compilation</td><td><input name=\"compilation\" type=\"text\" value=\"" . $row['compilation'] . "\"</input></td></tr>
			<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
		</form>
        </table>";
echo "<br/><a href=../titlelst.php?artist=" . $row['artist'] . ">all titles for this artist</a>";
?>
</div>
<div class="floatright">
<h3>image</h3>
<form name="imagemod" method="get" action="../image/imgmodpt.php">
<!--<input type="hidden" value="<?php echo $_POST['id']; ?>">-->
<input type="hidden" name="title" value="<?php echo $_GET['id'];?>">
<?php
$rowc = 0;
#$sql="select * from image where title=" . $row[id];//echo $sql;
#$sql="select * from image where id in (select image from title_image where title = " . $row[id] . ")";
#$sql="select * from image where id in (select image from image_title where title = " . $row[id] . ")";
$sql="select * from image where id in (select image from image_title where title = " . $id . ")";
foreach($conn->query($sql) as $row) {
	#$rowc = rowc + 1;
	$rowc++;
	echo "<a href=\"../image/imgmodfm.php?image=" . $row['id'] . "\"><img src=\"" . $row['url'] . "\" width=100 height=100 /></a>";
}
if ($rowc==0) { echo "<a href=\"/mydb/image/imgaddfm.php?title=" . $row['id'] . "\">add image</a>
	<br/>
	<h4>link image</h4>";
	echo "<select name=\"img\" ><option value=0>";
	foreach($conn->query("select id,alt from image where id not in (select id from title) order by 2") as $row) {
		echo "<option value=\"". $row['id'] . "\">" . $row['alt'];
	}
	echo " </select><br/><input type=submit>";
}

?>

</form>
</div>
<div class="floatright">
<?php
$sql="select * from title_medium join medium on title_medium.medium=medium.id where title=" . $_GET["id"];
echo "<h3>title medium</h3>";
echo "<table><tr><th>medium<th>release year<th>label</tr>";
foreach($conn->query($sql) as $row) {
	echo "<tr><td>" . $row['medium'] . "</td><td>" . $row['release_year'] . "</td><td>" . $row['label'] . "</td></tr>";
}
?>
</table></div>
<div class="floatright"><table>
<?php
$sql="select * from title_listen where title=" . $_GET["id"];
echo "<h3>play history</h3>";
echo "<table><tr><th>date</tr>";
foreach($conn->query($sql) as $row) {
	echo "<tr><td>" . $row['listen_date'] . "</td><td><a href=lpldelpt.php?dt=" . $row['listen_date'] . "&ttld=" . $_GET["id"] . " </a>delete</td></tr>";
}
?>
<tr><td><a href="../lstplydf.php?id=<?php echo $id; ?>">last played</a></td></tr>
</table></div>
