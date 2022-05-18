<?php include 'leftmenu.php'; ?>
<head>

<style>
#table {
#table-layout:fixed;
#width:90%;
#overflow:hidden;
##border:1px solid #f00;
#word-wrap:break-word;
#}
#.wide {
##border:1px solid #f00;
#width:200px;
#}
#.narrow {
##border:1px solid #f00;
#width:40px;
#}
#.double {
##border:1px solid #f00;
#width:80px; margin:auto; border:1px solid;
#}
#.six { width:600px }
#
#.center {
#    #margin: auto;
#    width: 80px;
#    #padding: 20px;
#}
#.teeny { width:80px; }
#th,td {
##border:1px solid #f00;
#}
</style>
</head>
<?php if (empty($_GET['heading'])) {
	$h1 ="Images";
} else {
	$h1 = "Heading Images";
}
?>
<h1><?php echo $h1; ?></h1>

<?php include 'connect.php'; ?>

<!-- <table width="100"> -->

<table>
      <tr>
      	<!--
        <th class="wide">title
        <th class="wide">alt</th>
        -->
        <th>alt
        <th>url</th>
<!--        <td class="center"><a href="image/imgaddfm.php">add</a></td> -->
        <td><a href="image/imgaddfm.php">add</a></td>
    </tr>
    <?php
	$sql = "select concat(t.prefix,case length(t.prefix) when 0 then '' else ' ' end,t.title) ttl,i.id,i.alt,i.url
		from image i left outer join title t on i.title=t.id
		order by coalesce(t.title,i.alt)";
	$sql = "select concat(t.prefix,case length(t.prefix) when 0 then '' else ' ' end,t.title) ttl,i.id,i.alt,i.url
		from image i left outer join image_heading ih on ih.image=i.id
		order by coalesce(t.title,i.alt)";
	if (!empty($_GET['heading'])) {
		$sql = "select * from image join image_heading ih on id=image where ih.heading = " . $_GET['heading'];
	} else {
		$sql = "select * from image join image_heading ih on id=image";
	}
	//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr>
	<!--			<td class=\"wide\">" . $row['ttl'] . "</td>			-->
				<td class=\"wide\">" . $row['alt'] . "</td>
				<td>" . $row['url'] . "</td>
				<td><table class=\"teeny\"><tr>
				<td class=\"narrow\"><a href=\"image/imgmodfm.php?id=" . $row['id'] . "\">mod</a></td>
				<td class=\"narrow\"><a href=\"image/imgdelpt.php?id=" . $row['id'] . "\">del</a></td></tr></table></td>
			</tr>";
	}
	?>
</table>
