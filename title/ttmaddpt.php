<?php include '../leftmenu.php'; ?>
<h2>ttitle medium add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_POST["released"]=="") {
      $rlsd="null";
    } else {
      $rlsd = $_POST["released"];
    }
    if ($_POST["label"]=="null") {
      $lbl="null";
    } else {
      $lbl = $_POST["label"];
    }
    $sql = "insert into title_medium(title,medium,release_year,label)
	values (\"" . $_POST["title"] . "\",\"" . $_POST["medium"] . "\"," . $rlsd . ",\"" . $lbl . "\")";
    //echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount() . " row INSERTED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

echo "<br/><a href=\"ttlmdadf.php?id=" . $_POST['title'] . "\">add another medium</a>
<!-- <br/><a href=\"../image/imgaddfm.php?title=" . $_POST['title'] . "\">add image for this title</a> -->
<br/><a href=\"../image/imgaddfm.php?title=" . $_POST['title'] . "\">add image for this title</a>
<br/><a href=\"../titlelst.php?id=" . $_POST['title'] . "\">this title</a>
<br/><a href=\"../titlelst.php?artist=" . $_POST['artist'] . "\">titles for this artist</a>
<br/><a href=\"../titlelst.php\">all titles</a>";
include '../sitemap.php';
?>
