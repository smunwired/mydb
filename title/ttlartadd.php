<html>
<body>
<h1>Title</h1>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
<h2>Insert</h2>
<form method="post" action="ttladpst.php">
<table>
<tr><td>prefix</td><td><input type="text" name="prefix"></input></td></tr>
<tr><td>title</td><td><input type="text" name="title"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr></table>
</form>
</body></html>
