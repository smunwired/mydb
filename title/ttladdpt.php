<?php include '../leftmenu.php'; ?>
<h2>title add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
include '../connect.php';
if ($_POST["cmpltn"]=="on") { $cmpl = 1; } else { $cmpl = 0; }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into title(artist,prefix,title,first_released,compilation) values (" .
    	$_POST["artist"] . ",\"" . $_POST["prefix"] . "\",\"" . $_POST["title"] . "\"," . $_POST["frstrlsd"] . "," . $cmpl . ")";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	" row INSERTED successfully.<br/><a href=\"ttlmdadf.php?artist=" . $_POST['artist'] . "&id=" .
    	 $conn->lastInsertId() .
    	"\">add medium</a><br/><a href=\"../titlelst.php?id=" .
    	$conn->lastInsertId() .
    	"\">titles</a><br/><a href=\"../image/imgaddfm.php?title=" . $conn->lastInsertId() .
	"\">add image</a>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

