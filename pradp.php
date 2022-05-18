<?php
include 'connect.php';
include 'leftmenu.php'; ?>
<h1>Paragraph Add Post</h1>

<?php

$slashed=addslashes($_POST['txt']);
$updt = "insert into paragr (dt,txt) values ('" . $_POST['dt'] . "','" . $slashed . "')";

  echo "<p>" . $updt;
        try {
                        $stmt = $conn->prepare($updt);
                        $stmt->execute();
                        echo " <p>rows added ";
        } catch (Exception $e) {
                    echo "<br/>some kind of failure here...";
                    echo $e->getMessage();
                      throw $e;
        }
/*
include 'includes/bk_links.php';
*/
?>
<br><a href=day.php>day</a>
