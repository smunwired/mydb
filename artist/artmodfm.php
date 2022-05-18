<?php include '../leftmenu.php'; ?>
<h1>Artist Modify Form</h1>
<?php
include '../connect.php';
$id = $_GET['id'];
//echo "<br/>id: " . $_GET["id"];
try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
        echo "<table>";
        $sql = "select * from artist where id=" . $_GET["id"];
//echo $sql;
        foreach($conn->query($sql) as $row) {
                echo "<form method=\"post\"action=\"artmodpt.php\">
			<input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input>
			<tr><td>predx</td><td><input name=\"predx\" type=\"text\" value=\"" . $row['predx'] . "\"></input></td></tr>
			<tr><td>prefix</td><td><input name=\"prefix\" type=\"text\" value=\"" . $row['prefix'] . "\"></input></td></tr>
			<tr><td>firstname</td><td><input name=\"firstname\" type=\"text\" value=\"" . $row['firstname'] . "\"></input></td></tr>
			<tr><td>lastname</td><td><input name=\"lastname\" type=\"text\" value=\"" . $row['lastname'] . "\"></input></td></tr>
			<tr><td>joinstr</td><td><input name=\"joinstr\" type=\"text\" value=\"" . $row['joinstr'] . "\"></input></td></tr>
			<tr><td>bandname</td><td><input name=\"bandname\" type=\"text\" value=\"" . $row['bandname'] . "\"></input></td></tr>
			<tr><td>collaborators</td><td><input name=\"collaborators\" type=\"text\" value=\"" . $row['collaborators'] . "\"></input></td></tr>
			<tr><td>indexed name</td><td><input name=\"idxnm\" type=\"text\" value=\"" . $row['idxnm'] . "\"></input></td></tr>
			<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
		</form>";
//        echo $row['id'];
	}
        echo "</table>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
include 'sitemap.php';
?>
