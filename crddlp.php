<?php
include 'connect.php';
$dl="delete from card where id = " . $_GET['id'];
try {
$stmt = $conn->prepare($dl);
$stmt->execute();
echo $stmt->rowCount() . " creditor row(s) DELETED successfully.<br><a href=crdlst.php?accd=" . $_GET['accd'] . ">Cards</a><br/><a href=acclst.php>Accounts</a>";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
