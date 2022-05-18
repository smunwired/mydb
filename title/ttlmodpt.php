<?php include '../leftmenu.php'; ?>
<h2>title modify post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "update title set prefix=" . $_POST["prefix"] . ", title=" . $_POST["title"] );
    $sql = "update title set compilation = " . $_POST["compilation"] . ",artist = " . $_POST["artist"] . ",prefix=\"" . $_POST['prefix'] . "\", title=\"" . $_POST['title'] . "\",first_released=" . $_POST['first_released'] . " where id=" . $_POST['id'];

    // Prepare statement

    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

include 'sitemap.php';
?>
