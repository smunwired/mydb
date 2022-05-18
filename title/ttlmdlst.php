<?php include '../leftmenu.php'; ?>
<h1>title media list</h1>
<?php
include '../connect.php';
$sql="select t.id tid,tm.id id,t.title title,m.medium,release_year,label,artist
  from title t
  join title_medium tm on t.id=tm.title
  join medium m on tm.medium=m.id";
if (!empty($_GET['id'])) {
  $sql = $sql . " where t.id = " . $_GET['id'];
}
if (isset($_GET['artist'])) $artist=$_GET['artist']; else $artist=0;
echo "<table><tr><th>title<th>year<th>media<th>label<td colspan=\"2\" align=\"center\"><a href=\"ttlmdadf.php?id=" . $_GET['id'] . "&artist=" . $artist . "\">add</a></td></tr>";
foreach($conn->query($sql) as $row) {
  echo "<tr><td>" . $row['title'] .
  "</td><td>" . $row['release_year'] .
  "</td><td>" . $row['medium'] .
  "</td><td>" . $row['label'] .
  "</td><td><a href=\"ttlmdmdf.php?id=" . $row['id'] . "\">mod</a></td>
  <td><a href=\"ttlmddel.php?id=" . $row['id'] . "\">del</a></td>
  </tr>";
}
echo "</table>";

include '../sitemap.php';
?>
