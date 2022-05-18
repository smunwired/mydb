<?php
include 'connect.php';
$dl="delete from crdn where crdd = " . $_GET['crdd'];
try {
$stmt = $conn->prepare($dl);
$stmt->execute();
echo $stmt->rowCount() . " creditor row(s) DELETED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
