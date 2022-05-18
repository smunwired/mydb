<?php
include '../leftmenu.php';
?>
<h2>image add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

if ((empty($_POST['img']))&&(empty($_POST['url']))) {
	echo "img and url both empty, nothing to insert, GO BACK!";
} else {
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//    if (empty($_POST['title'])) { $title="null"; } else { $title="/"" . $_POST['title'] . "/""; }
	//    echo "<br/>post title : " . $_POST['title'];
///	//    if (empty($_POST['title'])) { echo "</br>title is empty</br>"; }
//	//    $title=$_POST['title'];if (empty($title)) { $title="null"; }
	    //"/"" . $_POST['title'] . "/"";
	//    $sql = "insert into image(heading,url,alt,display_seq,title)
	//    	values (\"" . $_POST["hd"] . "\",\"" . $_POST["url"] . "\",\"" . $_POST["alt"] . "\",\"" . $_POST["dseq"] . "\"," . $title . ")";
	//    $sql = "insert into image(heading,url,alt,display_seq)
	//    	values (\"" . $_POST["hd"] . "\",\"" . $_POST["url"] . "\",\"" . $_POST["alt"] . "\"," . $_POST["dseq"] . ")";
	    $sql = "insert into image(heading,url,alt)
	    	values (\"" . $_POST["hd"] . "\",\"" . $_POST["url"] . "\",\"" . $_POST["alt"] . "\")";
		//a new image will have a value in url
		if (!empty($_POST['url'])) {
	    	$sql = "insert into image(url,alt)
	    		values (\"" . $_POST["url"] . "\",\"" . $_POST["alt"] . "\")";
			//echo $sql;
	    	// Prepare statement
	    	$stmt = $conn->prepare($sql);

	    	// execute the query
	    	$stmt->execute();

	    	// echo a message to say the INSERT succeeded
	    	echo "<br/>" . $stmt->rowCount() . " image(s) INSERTED successfully";

	    	$lastinsertid = $conn->lastInsertID();
	    }
	    //if url is empty use selected image
	    if (empty($_POST['url'])) { $lastinsertid = $_POST['img']; }

	    if (!empty($_POST['title'])) {
		    $sql = "insert into image_title values (" . $lastinsertid . "," . $_POST['title'] . ")";
		    $stmt = $conn->prepare($sql);
		    $stmt->execute();
		    echo "<br/>" . $stmt->rowCount() . " image_title row(s) INSERTED successfully";
	    }
		if (!empty($_POST['hdng'])) {
			$sql = "insert into image_heading values (" . $lastinsertid . "," . $_POST['hdng'] . ")";
			$stmt=$conn->prepare($sql);
			$stmt->execute();
		    echo "<br/>" . $stmt->rowCount() . " image_heading row(s) INSERTED successfully";
	    }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>
<br/><a href="http://192.168.56.101/mydb/titlelst.php">titles</a>
<br/><a href="imagelst.php">images</a>
<br/><a href="top.php">top (php)</a>
<br/><a href="top.html">top (html)</a>
