<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$_SESSION["dyord"]='desc';
$_SESSION["dylmt"]=250;
$_SESSION["dtf"]=date('Y-m-d', strtotime("-1 year"));
$_SESSION["dtt"]=date('Y-m-d', strtotime("+1 month"));

include 'leftmenu.php'; 
?>
<h1>listen!</h1>
<?php
include 'connect.php';
$lasthead="zzz";
$titletally=0;
$sql="select i.id id,h.nm heading,if(url like 'http%',url,concat(\"images/\",url)) as url,i.alt alt,h.display_seq seq,it.title title,h.image_width wd,h.image_height ht
	from image i
	join image_heading ih on i.id=ih.image
	join heading h on ih.heading=h.id
	left outer join image_title it on i.id=it.image
	where h.display=1
	order by seq,heading";
$sql="select 	i.id id,
		h.nm heading,
		if(url like 'http%',url,concat('images/',url)) as url,
		i.alt alt,h.display_seq seq,
		it.title title,
		h.image_width wd,
		h.image_height ht,
		0 as first_released,
		fnfullname(a.id,0) as artist
from image i 
	join image_heading ih on i.id=ih.image 
	join heading h on ih.heading=h.id left outer 
	join image_title it on i.id=it.image 
	join title t on it.title=t.id 
	join artist a on a.id=t.artist
where h.display=1 and h.id!=16
union
select 		i.id id,
		h.nm heading,
		if(url like 'http%',url,concat('images/',url)) as url,
		i.alt alt,
		h.display_seq seq,
		it.title title,
		h.image_width wd,
		h.image_height ht,
		first_released,
		null as artist
from image i 
	join image_heading ih on i.id=ih.image 
	join heading h on ih.heading=h.id left outer 
	join image_title it on i.id=it.image left outer 
	join title t on t.id=it.title
where h.display=1 and h.id=16
order by seq,heading,artist,first_released";

foreach($conn->query($sql) as $row) {
	$titletally = $titletally + 1;
	if ($lasthead!=$row['heading']) {
		echo "<br/>" . $titletally . "</br>";
		echo "<h4>" . $row['heading'] . "</h4>";
		$titletally=0;
	}
	echo "<a href=\"image/imgmodfm.php?image=" . $row['id'] . "\"><img width=\"" . $row['wd'] .
		"\" height=\"" . $row['ht'] . "\" title=\"" . $row['alt'] . "\" src=\"" . $row['url'] . "\"/></a>\n";
	$lasthead = $row['heading'];
}

echo "<h2>images in url subdirectory needing better names</h2>";
$directory = "/var/www/html/mydb/images/url";
$images = glob($directory . "/*.jpg");

foreach($images as $image) { 
  echo "<img height=\"100\" width=\"100\" src=\"" . 
	substr($image,13) . "\" title=\"" . 
	substr($image,strripos($image,'/')+1) . "\">"; 
}
include 'sitemap.php'
?>
