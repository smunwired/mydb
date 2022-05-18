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
    $sql = "update bk_flight set nm='" . $_POST['nm'] . "',dpdst=" . $_POST['dpdst'] . ", dptm='" . $_POST['dptm'] . "',ardst=" . $_POST['ardst'] . ",artm='" . $_POST['artm'] . "' where id = " . $_POST['id'];

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	" row UPDATED successfully.<br/>" .  $conn->lastInsertId(); 
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
include 'includes/bk_links.php';
?>

