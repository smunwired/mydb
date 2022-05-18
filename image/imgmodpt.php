<?php 
//include 'leftmenu.php'; ?>
<?php
include '../leftmenu.php';
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

if (empty($_POST["title"])) { $title="null"; } else { $title=$_POST["title"]; }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!empty($_POST['heading']))||(!empty($_POST['url']))||(!empty($_POST['alt']))||(!empty($_POST['title']))) {
//	    $sql = "update image set heading=\""
//	    . $_POST["hd"]
//	    . "\",url=\"" . $_POST["url"] . "\",alt=\"" . $_POST["alt"] . "\",title=" . $title . ",display_seq=" . $_POST["dseq"] . " where id=" . $_POST["id"];
	    $sql = "update image set
	    url=\"" . $_POST["url"] . "\",alt=\"" . $_POST["alt"] . "\" where id=" . $_POST["id"];
	} else if (!empty($_GET['title'])) {
		$sql="insert into image_title values (" . $_GET['img'] . "," . $_GET['title'] . ")";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo "<br/>" . $stmt->rowCount() . " image_title records INSERTED successfully<br/>";
	} else if (!empty($_POST['hdn'])) {
		$sql="insert into image_heading values (" . $_POST['id'] . "," . $_POST['hdn'] . ")";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo "<br/>" . $stmt->rowCount() . " image_heading records INSERTED successfully<br/>";
	}
	echo $sql;

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    echo "<br/>" . $stmt->rowCount() . " image row(s) UPDATED successfully<br/>";

	if (!empty($_POST['hdn'])) {
		$sql="insert into image_heading values (" . $_POST['id'] . "," . $_POST['hdn'] . ")";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo "<br/>" . $stmt->rowCount() . " image_heading records INSERTED successfully<br/>";
	}

} catch(PDOException $e){
    echo "<br><b>failure</b><br>" . $e->getMessage() . "<br><b>sql </b><br>" . $sql;
}

$conn = null;
include '../sitemap.php';
?>





