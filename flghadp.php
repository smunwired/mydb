<?php include 'leftmenu.php'; ?>
<h2>title add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
if (empty($_POST['opr'])) { $opr="null"; } else { $opr = $_POST['opr']; }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into bk_flight(nm, dpdst, dptm, ardst, artm, opr) values (\"" .
    	$_POST["nm"] . "\"," . 
	$_POST["dprtdst"] . ",\"" . $_POST["dprttm"] . "\"," . 
	$_POST["arvldst"] . ",\"" . $_POST["arvltm"] . "\"," . $opr . ")";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	" added flight <b>" . $_POST['nm'] . "</b>. id : " . $conn->lastInsertId() ;

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
include 'includes/bk_links.php';
?>

