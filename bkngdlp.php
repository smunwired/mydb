<?php include 'leftmenu.php'; ?>
<h2>delete booking </h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
$id = $_GET['id'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from bk_booking where id = " . $id ;  

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount() . " row with ID " . $id . " DELETED successfully.";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
include 'includes/bk_links.php';
?>

