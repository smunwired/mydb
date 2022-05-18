<?php include 'leftmenu.php'; ?>
<h2>title add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "update bk_carrier set nm =  \"" . $_POST['nm'] . "\" where id=" . $_POST['id'] ;  

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	" row UPDATED successfully.<br/><a href=\"ttlmdadf.php?artist=" . $_POST['carrier'] . "&id=" .
    	 $conn->lastInsertId() .
    	"\">add medium</a><br/><a href=\"../titlelst.php?id=" .
    	$_POST['artist'] .
    	"\">titles</a>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

