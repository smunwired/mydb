<?php
include 'connect.php';
$dt = $_POST['std'];
echo "std : " . $dt;
echo "tid : " . $_POST['tid'];
echo "dd : " . $_POST['dd'];
$amt = abs($_POST['amt']);
echo "amt : " . $amt;
if ($_POST['dd']==0) {
  $set="update transdet set tran_amount = " . $amt . ",statement_date = '" . $dt . "',date_amended=now() where tran_id = " . $_POST['tid'];
} else {
  $set="update transdet set tran_amount = " . $amt . ",statement_date = '" . $dt . "',tran_date='" . $dt . "',date_amended=now() where tran_id = " . $_POST['tid'];
}
echo "set " . $set;
try {
$stmt = $conn->prepare($set);
$stmt->execute();
echo $stmt->rowCount() . " transdet statement dates UPDATED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
