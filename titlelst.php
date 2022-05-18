<?php include 'leftmenu.php'; 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<h1>titles</h1>

<?php
include 'connect.php';
$ttlfnd = 0;
$select="select  
		t.id id, fnfullname(a.id,1) artist, a.id aid, concat(t.prefix,case when length(t.prefix)=0 then '' else ' ' end,t.title) title,
        	count(tm.label) media, coalesce(first_released,min(release_year),'') released, count(i.id) imgc, compilation
	from title t
	left join title_medium tm on t.id=tm.title
	join artist a on a.id=t.artist
	left join image i on i.title=t.id";
$grp = " 	group by t.id, fnfullname(a.id,1), a.id, concat(t.prefix,case when length(t.prefix)=0 then '' else ' ' end,t.title), compilation 
		order by idxnm, coalesce(first_released,min(release_year),'')";
/*		order by fnfullname(a.id,0), coalesce(first_released,min(release_year),'')";	*/
/* set wholly unneccessary variables to get rid of annoying messages */
if (isset($_GET["artist"])) $artist=$_GET["artist"]; else $artist=0;
if (isset($_GET["id"])) $id=$_GET["id"]; else $id=0;
if ($artist!=0) {
  $sql=$select . " where a.id=" . $_GET["artist"] . $grp;
} elseif ($id!=0) {
  $sql=$select . " where t.id=" . $id . $grp;
} else {
  $sql=$select . $grp;
}
echo "<p>" . $sql . "</p>";
echo "<table class=\"nobr\">";
$lastartst = "zzzz";
foreach($conn->query($sql) as $row) {
  $ttlfnd = 1;
  echo "<tr>";
  if ($lastartst!=$row['artist']) {
    $lastartst=$row['artist'];
    echo "<td><b>" . $row['artist'] .  "</b></tr>
      <tr><th class=\"leftpaddedcellgray\">title
          <th class=\"subheading\">year<th class=\"subheading\">compilation<th class=\"subheading\">media count
          <td  class=\"subheading\" colspan=\"4\" align=\"center\"><a href=\"title/ttladdfm.php?id=" . $row["aid"] . "\">add</a></td></tr>";
  }
  echo "<tr><td class=\"leftpaddedcell\">" . $row['title'] .
    "</td><td>" . $row['released'] .  
    "</td><td class=\"cntr\">" . $row['compilation'] .
    "</td><td class=\"cntr\">" . $row['media'] .
    "</td><td><a href=\"title/ttlmodfm.php?id=" . $row['id'] . "\">mod</a></td>
    <td><a href=\"title/titledel.php?id=" . $row['id'] . "\">del</a></td>
    <td><a href=\"title/ttlmdlst.php?id=" . $row['id'] . "\">list title media</a></td>
    <td><a href=\"title/ttlmdadf.php?id=" . $row['id'] . "\">add title medium</a></td>";
    if ($row['imgc']==0) {
    	echo "<td><a href=\"image/imgaddfm.php?title=" . $row['id'] . "\">add image</a></td>";
    } else {
    	echo "<td><a href=\"image/imgmodfm.php?title=" . $row['id'] . "\">image</a></td>";
    }
    echo "<td>
<a href=\"lstplydf.php?id=" . $row['id'] . "\" target=_blank >last played</a>
</td>";
  echo "</tr>";
}
if ($ttlfnd==0) {
  echo "<tr><td>No titles found for <b>" . $_GET['artstnm'] . "</b></td><td><a href=\"title/ttladdfm.php?id=" . $_GET["artist"] . "\">add</a></td></tr>";
}
echo "</table>";
include 'sitemap.php';
?>
</body></html>
