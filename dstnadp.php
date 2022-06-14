<?php include 'leftmenu.php'; ?>
<h2>title add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

if (empty($_POST['cd'])) {
  echo "empty<br/>";
  $cd='null';
} else {
  $cd = ("\"" . $_POST['cd'] . "\"");
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into bk_destination(cd,nm) values (" . $cd . ",\"" . $_POST['nm'] . "\")";  

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount() .  " row, ID " .  $conn->lastInsertId() .  " INSERTED successfully.";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

