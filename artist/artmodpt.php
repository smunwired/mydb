<?php
include '../leftmenu.php';
$servername = "localhost";
$username = "stef";
$password = "pass";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

try {
	$sql = "update artist set prefix=\"" . $_POST["prefix"] . 
		"\",firstname=\"" . $_POST["firstname"] . 
		"\",lastname=\"" . $_POST["lastname"] . 
		"\",joinstr=\"" . $_POST["joinstr"] . 
		"\",bandname=\"" . $_POST["bandname"] . 
		"\",collaborators=\"" . $_POST["collaborators"] . 
		"\",idxnm=\"" . $_POST["idxnm"] . 
		"\",predx=\"" . $_POST["predx"] . 
		"\" where id=" . $_POST["id"];
	echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully<br/><a href=\"/mydb/artstlst.php\">artists</a>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

include '../sitemap.php';
?>
