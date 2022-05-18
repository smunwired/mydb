<?php include '../leftmenu.php'; ?>
<h1>Title Medium Modify Post</h1>
<?php
include '../connect.php';

$sql = "update title_medium set medium=\"" . $_POST["medium"] .  "\", release_year=\"" . $_POST["release_year"] .
	"\", label=\"" . $_POST["label"] . "\" where id = " . $_POST['id'];


$stmt = $conn->prepare($sql);

$stmt->execute();

echo $stmt->rowCount() . " row UPDATED successfully";

$conn = null;

echo "<br/> <a href=\"ttlmdlst.php?id=\"" . $_POST["id"] .  "\">title media for artist</a>";
//echo "<br/> <a href=\"titlelst.php?id=\"" . $_POST["id"] .  "\">titles for artist</a>";
//echo "<br/> <a href=\"titlelst.php?id=\"" . $_POST["id"] .  "\">all titles</a>";

include '../sitemap.php';
?>
