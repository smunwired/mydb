<?php
include 'connect.php';
$isrt="insert into title_listen(title,listen_date) values (" . $_POST['ttl'] . ",'" . $_POST['lstndt'] . "')";
echo "<p>isrt : " . $isrt;
try {
  $stmt = $conn->prepare($isrt);
  $stmt->execute();
  echo "<p>" . $stmt->rowCount() . " listen dates INSERTED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
<br/>
<a href="day.php">day</a>
<br />
<?php echo "<a href=title/ttlmodfm.php?id=" . $_POST['ttl'] . ">title</a>"; ?>
