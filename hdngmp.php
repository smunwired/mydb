<?php //include 'leftmenu.php'; ?>
<h1>heading modify post</h1>
<?php
include 'connect.php';
$upd = "update heading set nm = \"" . $_GET['hdng'] . "\",display=" .  $_GET['dsply'] . ",display_seq=" .  $_GET['dsplysq'] . ",image_width=" . $_GET['wd'] . ",image_height=" . $_GET['ht'] . " where id = " . $_GET['id'];
echo $upd;
try {
	// Prepare statement
	$stmt = $conn->prepare($upd);

	// execute the query
	$stmt->execute();

	// echo a message to say the UPDATE succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) UPDATED successfully";
	echo "<br/><a href=\"heading.php\">list</a>";
} catch (Exception $e) {
    // Here you can either echo the exception message like:
	echo $e->getMessage();
    /* Or you can throw the Exception Object $e like:
        throw $e;
    */
}
?>
