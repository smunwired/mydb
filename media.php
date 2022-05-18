<?php include 'leftmenu.php'; ?>
<h1>media</h1>
<?php
include 'connect.php';
$lasthead="zzz";
$sql="select m.medium medium, 100 wd, 100 ht, if(url like 'http%',url,concat(\"images/\",url)) as url, alt, i.id image
	from title t
	join title_medium tm on tm.title=t.id
	join image_title it on it.title=t.id
	join image i on i.id=it.image
	join medium m on tm.medium=m.id
group by m.medium, wd, ht, if(url like 'http%',url,concat(\"images/\",url)), alt, i.id 
	order by m.id";

foreach($conn->query($sql) as $row) {
	if ($lasthead!=$row['medium']) {
		echo "<h4>" . $row['medium'] . "</h4>";
	}
	echo "<a href=\"image/imgmodfm.php?image=" . $row['image'] . "\"><img width=\"" . $row['wd'] . "\" height=\"" . $row['ht'] . "\" title=\"" . $row['alt'] . "\"src=\"" . $row['url'] . "\"/></a>";
	$lasthead = $row['medium'];
}


include 'sitemap.php'
?>
