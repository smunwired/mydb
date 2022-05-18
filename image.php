<?php include 'leftmenu.php'; ?>
<h1>Image</h1>

<?php include 'connect.php'; ?>

<!--
<table>
      <tr>
        <th>alt
        <th>url</th><th>heading<th>title
        <td colspan="2" align="center"><a href="image/imgaddfm.php">add</a></td>
    </tr>
    <?php
	foreach($conn->query("select * from image") as $row) {
		echo "<tr>
				<td class=\"wide\">" . $row['alt'] . "</td>
				<td>" . $row['url'] . "</td>
				!--
				<td><table class=\"teeny\"><tr>
				<td class=\"narrow\"><td class=\"narrow\"><a href=\"image/imgmodfm.php?image=" . $row['id'] . "\">mod</a></td>
				<td class=\"narrow\"><a href=\"image/imgdelpt.php?image=" . $row['id'] . "\">del</a></td></tr></table></td>
				--
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><a href=\"image/imgmodfm.php?image=" . $row['id'] . "\">mod</a></td>
				<td><a href=\"image/imgdelpt.php?image=" . $row['id'] . "\">del</a></td>
			</tr>";
	}
	?>
</table>
-->
<?php
	foreach($conn->query("select id,if(substr(url,1,4)=\"http\",url,concat('images/',url)) url from image;") as $row) {
		echo "<a href=\"image/imgmodfm.php?image=" . $row['id'] . "\"><image src=" . $row['url'] . " height=100 width=100 /></a>";
	}
?>
