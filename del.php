<?php
include 'connect.php';
$dl="delete from transdet where tran_id = " . $_GET['tid'];
try {
$stmt = $conn->prepare($dl);
$stmt->execute();
echo $stmt->rowCount() . " transdet row(s) DELETED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
