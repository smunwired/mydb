<?php include '../leftmenu.php'; ?>
<?php
include '../connect.php';
?>
<html>
<body>
<h1>image heading modify form</h1>
<table>
<form method="post" action="ihmodpt.php">
<?php





$image = $_GET['imgd'];
$sql="select heading.id heading,nm,image_heading.image image from heading join image_heading on id=heading where image=" . $image;
foreach($conn->query("$sql") as $hdng) {
	echo "<tr><td>" . 
		$hdng['nm'] . 
		"</td><td><a href=ihdelpt.php?hdngd=" . 
		$hdng['heading'] . 
		"&imgd=" . 
		$hdng['image'] . 
		" </a>remove</td></tr>";
}
/*
$stmt = $conn->prepare("select id,alt,if(url like 'http%',url,concat(\"../images/\",url)) as murl,url from image where id=" . $imgd);
$stmt->execute();
$row = $stmt->fetch();

?>
<?php
$sql="select t.id id,t.title title,a.id artist,it.image image from title t join artist a on t.artist=a.id left outer join image_title it on t.id=it.title where image.id = " . $_GET[imgid] . "order by title";
echo $sql;
foreach($conn->query("$sql") as $ttl) {
	if (intval($_GET['image'])==$ttl['image']){
		echo "<option value=" . $ttl['id'] . " selected>" . $ttl['title'];
		$title=$ttl['id']; 
		$artist=$ttl['artist'];
	} else {
		echo "<option value=" . $ttl['id'] . ">" . $ttl['title'];
	}
}
if (empty($title)) { $title=0; }if (empty($artist)) { $artist=0; }
?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<?php echo "<img width=\"100\" height=\"100\" title=\"" . $row['alt'] . "\"src=\"" . $row['murl'] . "\"/>"; ?>
<tr><td>link to title</td><td><select name="title"><option value="">
<?php
$title=1000;
$sql="select t.id id,t.title title,image from image_title it right outer join title t on it.title=t.id order by title";
$sql="select t.id id,t.title title,image,concat(a.id,0) artist from image_title it right outer join title t on it.title=t.id right outer join artist a on a.id=t.artist order by title";
$sql="select t.id id,t.title title,a.id artist from title t join artist a on t.artist=a.id left outer join image_title it on t.id=it.title order by title";
$sql="select t.id id,t.title title,a.id artist,it.image image from title t join artist a on t.artist=a.id left outer join image_title it on t.id=it.title order by title";
foreach($conn->query("$sql") as $ttl) {
	if (intval($_GET['image'])==$ttl['image']){
		echo "<option value=" . $ttl['id'] . " selected>" . $ttl['title'];
		$title=$ttl['id']; 
		$artist=$ttl['artist'];
	} else {
		echo "<option value=" . $ttl['id'] . ">" . $ttl['title'];
	}
}
if (empty($title)) { $title=0; }if (empty($artist)) { $artist=0; }
?>
<select></td></tr>
<tr><td>current headings</td><td>
<?php
$sql="select id, nm title,ifnull(image,0) image from heading left outer join image_heading on heading=id order by title";
$sql="select id id,nm title,null image from heading union select id,nm,ih.image from heading h left outer join image_heading ih on h.id=ih.heading where image=" . $_GET['image'] . " order by title";
$sql="select id, title, sum(image) image from (select id id,nm title,0 image from heading union select id,nm title,ih.image image from heading h left outer join image_heading ih on h.id=ih.heading where image=" . $_GET['image'] . ") as tab group by id, title";
$sql="select id, nm title from heading order by 2";
$sql="select nm from heading join image_heading on id=heading where image=" . $_GET['image'];
foreach($conn->query("$sql") as $hdng) {
	echo $hdng['nm'] . ",";
}

?></td><td><a href=hdngslmd.php&imgd=<?php echo $image ?>>edit selected headings</a></td></tr>
<tr><td>link to more heading</td><td><select name="hdn"><option value="">
<?php
//$sql="select id, nm title,ifnull(image,0) image from heading left outer join image_heading on heading=id order by title";
//$sql="select id id,nm title,null image from heading union select id,nm,ih.image from heading h left outer join image_heading ih on h.id=ih.heading where image=" . $_GET['image'] . " order by title";
//$sql="select id, title, sum(image) image from (select id id,nm title,0 image from heading union select id,nm title,ih.image image from heading h left outer join image_heading ih on h.id=ih.heading where image=341) as tab group by id, title";
//echo $sql;
$sql="select id,nm,sum(flag) from (select id,nm,1 flag from heading union all select id,nm,1 flag from heading join image_heading on heading=id and image=" . $_GET['image'] . ") n group by id,nm having sum(flag)=1";
foreach($conn->query($sql) as $hdn) {
	echo "<option value=" . $hdn['id'] . ">" . $hdn['nm'];
}
?>
-->
<!--
<select></td></tr>
<tr><td>url</td><td><input type="text" name="url" value="<?php echo $row['url']; ?>"></input></td></tr>
<tr><td>alt</td><td><input type="text" name="alt" value="<?php echo $row['alt']; ?>"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
<tr>
	<td><a href="../lstplydf.php?id=<?php echo $title; ?>">last played</a></td>
	<td><a href="../artstlst.php?id=<?php echo $artist; ?>">artist</a></td>
	<td><a href="../titlelst.php?id=<?php echo $title; ?>">title</a></td>
	<td><a href="../titlelst.php?artist=<?php echo $artist	; ?>">titles for artist</a></td>
-->
*/
?>

</tr>
</table>
</form>
</table>
</body>

</html>
