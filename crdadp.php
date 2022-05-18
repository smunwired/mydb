<?php include 'leftmenu.php'; ?>
<h2>card add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into card(account_id,card_number,valid_from,expires) values (\"" . $_POST['account_id'] . "\",\"" . $_POST['card_number'] . "\",\"" . $_POST['valid_from'] . "\",\"" .  $_POST['expires'] . "\")";  
//echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	" row INSERTED successfully." . $_POST['carrier'] . "&id=" .
	$conn->lastInsertId() . "<br/><a href=\"crdlst.php?accd=" . $_POST['account_id']. "\">Cards</a><br/><a href=\"acclst.php\">Accounts</a>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

