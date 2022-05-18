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
    $sql = "update account set account_name =  \"" . $_POST['accn'] . "\"  where account_id=" . $_POST['accd'] ;  

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    " row UPDATED<br/> <a href=\"acclst.php\">Accounts</a>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

